<?php
namespace Mobingi\Alm\Template\Traits;
use Mobingi\Alm\Template\Mappers\Aws\CloudFormationParameters as CFParams;
use Mobingi\Alm\Template\Mappers\Aws\CloudFormationResources as CFResources;
use Mobingi\Alm\Template\Mappers\Aws\CloudFormationSyntax as CFSyntax;
use Mobingi\Core\ClientBase;
use Mobingi\Core\Utility\Common;
use Mobingi\Exception\FailtureStackException;
use \RecursiveIteratorIterator;
use \RecursiveArrayIterator;

/**
 * Convert Clients Trait
 * @package Mobingi\Alm\Template\Traits
 */
trait ConvertTrait {
    /**
     * append the parameter name/value into CloudFormation Template
     * @param string $format Cloudformation template body in Json format
     * @param array $keys key value of array CFParams::MAPPINGS_PARAM
     * @param string $flag the flag name of each configuration
     * @return void
     */
    protected function appendCFTemplateParameters($format, $keys, $flag){
        foreach ($keys as $key) {
            $paramID = $key.$this->getLogicalId($flag);
            $format->Parameters->$paramID = CFParams::MAPPINGS_PARAM[$key];
        }
        // return $format;
    }

    /**
     * append the resource name/values into CloudFormation Template
     * @param string $format Cloudformation template body in Json format
     * @param array $keys key value of array CFParams::MAPPINGS_RESOURCE
     * @param object $configuration each configuration layer found in template body
     * @param string $template_id ID of current template associated with stack
     * @param string $flag the flag name of each configuration
     * @param object $cred
     * @param array $extra extra infos needs to pass to CloudFormation
     * @return void
     */
    protected function appendCFTemplateResources($format, $keys, $configuration, $flag, $template_id = null, $cred = null, $extra = null){

        foreach ($keys as $key) {
            $LogicalID = $key.$this->getLogicalId($flag);
            $format->Resources->$LogicalID = (object) CFResources::MAPPINGS_RESOURCE[$key];
        }

        foreach ($keys as $key) {
            $LogicalID = $key.$this->getLogicalId($flag);

            /*
            * Subnet
            * If provided, rewrite the default settings
            */
            if($key === 'Subnet'){
                if($configuration->provision->subnet){

                    $format->Resources->$LogicalID->Type = "AWS::EC2::Subnet";
                    $this->setCFResourceProperties(
                        $format,
                        $LogicalID,
                        $this->convertSyntax($configuration->provision->subnet)
                    );
                    $this->replaceResourceProperty($format,'Subnet',$flag,
                        ['VpcId' => [ "Ref" => "VPC"]]
                    );

                    //insert az for subnet property
                    $format->Resources->$LogicalID->Properties->AvailabilityZone = $configuration->provision->availability_zone;

                    //if $provision->subnet->public is true, this is a public subnet, we need to:
                    // - add Route Table,
                    // - add Route
                    // - add SubnetRouteTable Association
                    if($configuration->provision->subnet->public){
                        //add route table <-> subnet association
                        $key_assoc = "SubnetRouteTableAssociation".$this->getLogicalId($flag);
                        $format->Resources->$key_assoc = (object) CFResources::MAPPINGS_RESOURCE["SubnetRouteTableAssociation"];

                        // $this->replaceResourceProperty($format,'Route',$this->getLogicalId($flag),
                        //     ['DestinationCidrBlock' => "0.0.0.0/0"]
                        // );
                    }else{
                        $key_assoc = "Route".$this->getLogicalId($flag);
                        unset($format->Resources->$key_assoc);
                        $key_assoc = "RouteTable".$this->getLogicalId($flag);
                        unset($format->Resources->$key_assoc);
                    }
                    //remove unnecessary properties for CF Resource entry
                    unset($format->Resources->$LogicalID->Properties->public);

                }
            }
            /*
            * EC2SecurityGroup
            * If provided, rewrite the default settings
            */
            if($key === 'EC2SecurityGroup'){
                if($configuration->provision->security_group){
                    $this->setCFResourceProperties(
                        $format,
                        $LogicalID,
                        $this->convertSyntax($configuration->provision->security_group)
                    );
                    $this->replaceResourceProperty($format,'EC2SecurityGroup',$flag,
                        [
                            'GroupDescription' => "Mobingi Generated Security Group",
                            'VpcId' => [ "Ref" => "VPC"]
                        ]
                    );
                }
            }
            /*
            * NetworkAcl
            * If provided, rewrite the default settings
            */
            if($key === 'NetworkAcl' && is_array($configuration->provision->network_acl)){

                //delete default NetworkAclEntry
                $keyname = "NetworkAclEntry" . $flag;
                unset($format->Resources->$keyname);
                //replace NetworkAclEntries
                foreach($configuration->provision->network_acl as $k => $network_acl){
                    $keyname = "NetworkAclEntry" . $k . $this->getLogicalId($flag);
                    $format->Resources->$keyname->Type = "AWS::EC2::NetworkAclEntry";
                    $this->setCFResourceProperties(
                        $format,
                        $keyname,
                        $this->convertSyntax($network_acl)
                    );
                    $this->replaceResourceProperty($format,'NetworkAclEntry'.$k,$flag,
                        ['NetworkAclId' => [ "Ref" => "NetworkAcl"]]
                    );
                }

            }

            /*
            * EC2 Instance
            * Single Instances (multiple) without ELB and autoscaling group
            */
            if($key === 'EC2Instance'){

                //@to-do:
                //replace CFParams InstanceType to $configuration->provision->instance_type
                //replace CFParams MachineVolumeSize $configuration->provision->volume_size

                //removes the old Resource item by LogicalID
                unset($format->Resources->$LogicalID);

                $i = 0;
                while ($i < $configuration->provision->instance_count) {
                    $LogicalID_update = "EC2Instance" . $i . $this->getLogicalId($flag); //insert new LogicalID
                    $format->Resources->$LogicalID_update = (object) CFResources::MAPPINGS_RESOURCE["EC2Instance"]; //copy the Resource item
                    //add normal properties
                    $this->replaceResourceProperty($format,"EC2Instance".$i,$flag,
                        [
                            'InstanceType' => [ "Ref" => "InstanceType"],
                            'AvailabilityZone' => $configuration->provision->availability_zone,
                            // 'BlockDeviceMappings' => ['Ebs' => [ 'VolumeSize' => ['Ref' => 'MachineVolumeSize']]]
                        ]
                    );
                    //if enable keypair, need explicitely create a KeyPair first
                    if($configuration->provision->keypair){
                        $this->replaceResourceProperty($format,'EC2Instance'.$i,$flag,
                            [
                                'KeyName' => $template_id.'-'.$flag
                            ]
                        );
                    }
                    //add alm-agent support
                    if($configuration->container){
                        //add Instance Iam Role related Resource for Alm-agent
                        $format->Resources->MobingiInstanceProfile = (object) CFResources::MAPPINGS_RESOURCE["MobingiInstanceProfile"]; //copy the Resource item
                        $format->Resources->AlmAgentPolicy = (object) CFResources::MAPPINGS_RESOURCE["AlmAgentPolicy"]; //copy the Resource item
                        $format->Resources->MobingiAlmRole = (object) CFResources::MAPPINGS_RESOURCE["MobingiAlmRole"]; //copy the Resource item

                        $LogicalID_ContainerWaitCondition = "ContainerWaitCondition" . $this->getLogicalId($flag); //insert new LogicalID
                        $depends = (array) $format->Resources->$LogicalID_ContainerWaitCondition->DependsOn;
                        array_push($depends, 'EC2Instance'.$i.$flag);
                        $format->Resources->$LogicalID_ContainerWaitCondition->DependsOn = $depends;
                        $extra['Flag'] = $flag;
                        $extra['Lifecycle'] = 'normal';
                        $format->Resources->$LogicalID_update->Metadata = $this->getMetaData($extra,$flag);
                        $this->replaceResourceProperty($format,'EC2Instance'.$i,$flag,
                            [
                                'UserData' => [
                                    "Fn::Base64" => [
                                        "Fn::Join" => [
                                            "",
                                            $this->getUserData($LogicalID_update,"ContainerWaitConditionHandle".$flag)
                                        ]
                                    ]
                                ],
                                'IamInstanceProfile' => [
                                    "Ref" => "MobingiInstanceProfile"
                                ]
                            ]
                        );
                    }
                    $i++;
                }

            }

            /*
            * EC2 AutoScalingGroup
            * Auto scaling Instances with ELB and autoscaling group
            */
            if($key === 'ASAutoScalingGroup'){

                //@to-do:
                //replace $configuration->provision->auto_scaling->availability_zones into
                //[ "ap-northeast-1a", "ap-northeast-1c"]
                if(!empty($configuration->provision->auto_scaling->availability_zones)){
                    $azs = preg_replace('/\s+/', '', $configuration->provision->auto_scaling->availability_zones);
                    $azs = explode(",", $azs);
                    $this->replaceResourceProperty($format,'ASAutoScalingGroup',$flag,
                        [
                            'AvailabilityZones' => $azs
                        ]
                    );
                }
                //add ASG VPCZoneIdentifier (subnet ids)
                if(!empty($configuration->provision->auto_scaling->subnets)){
                    $asgsubnets = preg_replace('/\s+/', '', $configuration->provision->auto_scaling->subnets);
                    $asgsubnets = explode(",", $asgsubnets);
                    $asgsubnetsRef = [];
                    foreach($asgsubnets as $asgsubnet){
                        array_push($asgsubnetsRef, ['Ref' => ['RefLogicalID'=>$asgsubnet, 'NoSuffix'=>true]]);
                    }
                    $this->replaceResourceProperty($format,'ASAutoScalingGroup',$flag,
                        [
                            'VPCZoneIdentifier' => $asgsubnetsRef
                        ]
                    );
                }
                //add ASG AZs
                $this->replaceResourceProperty($format,'ASAutoScalingGroup',$flag,
                    [
                        'MaxSize' => $configuration->provision->auto_scaling->max,
                        'MinSize' => $configuration->provision->auto_scaling->min
                    ]
                );

                //add alm-agent support
                if($configuration->container){
                    $LogicalID_ContainerWaitCondition = "ContainerWaitCondition" . $this->getLogicalId($flag); //insert new LogicalID
                    $depends = (array) $format->Resources->$LogicalID_ContainerWaitCondition->DependsOn;
                    array_push($depends, $LogicalID);
                    $format->Resources->$LogicalID_ContainerWaitCondition->DependsOn = $depends;
                    $extra['Flag'] = $flag;
                    $extra['Lifecycle'] = 'normal';
                    $format->Resources->$LogicalID->Metadata = $this->getMetaData($extra);

                }

            }

            /*
            * EC2 AutoScaling Launch Configuration Groups
            * Auto scaling Instances with ELB and autoscaling group
            */
            if($key === 'ASLaunchConfiguration'){

                //@to-do:
                //"AssociatePublicIpAddress" value to map subnet's settings
                //replace ${use(flag.Web01.provision.security_group)} to LogicalID name

                //add ELB Security groups
                if(!empty($configuration->provision->auto_scaling->security_groups)){
                    $lbsgs = preg_replace('/\s+/', '', $configuration->provision->auto_scaling->security_groups);
                    $lbsgs = explode(",", $lbsgs);
                    $lbsgsRef = [];
                    foreach($lbsgs as $lbsg){
                        array_push($lbsgsRef, ['Ref' => ['RefLogicalID'=>$lbsg, 'NoSuffix'=>true]]);
                    }
                    $this->replaceResourceProperty($format,'ASLaunchConfiguration',$flag,
                        [
                            "SecurityGroups" => $lbsgsRef
                        ]
                    );
                }

                //if enable keypair, need explicitely create a KeyPair first
                if($configuration->provision->keypair){
                    $this->replaceResourceProperty($format,'ASLaunchConfiguration',$flag,
                        [
                            'KeyName' => $template_id.'-'.$flag
                        ]
                    );
                }

                //add alm-agent support
                if($configuration->container){

                    //add Instance Iam Role related Resource for Alm-agent
                    $format->Resources->MobingiInstanceProfile = (object) CFResources::MAPPINGS_RESOURCE["MobingiInstanceProfile"]; //copy the Resource item
                    $format->Resources->AlmAgentPolicy = (object) CFResources::MAPPINGS_RESOURCE["AlmAgentPolicy"]; //copy the Resource item
                    $format->Resources->MobingiAlmRole = (object) CFResources::MAPPINGS_RESOURCE["MobingiAlmRole"]; //copy the Resource item

                    $this->replaceResourceProperty($format,"ASLaunchConfiguration",$flag,
                        [
                            'UserData' => [
                                "Fn::Base64" => [
                                    "Fn::Join" => [
                                        "",
                                        $this->getUserData('ASAutoScalingGroup'.$flag,'ContainerWaitConditionHandle'.$flag)
                                    ]
                                ]
                            ],
                            'IamInstanceProfile' => [
                                "Ref" => "MobingiInstanceProfile"
                            ]
                        ]
                    );
                }


            }


            /*
            * EC2 AutoScaling Launch ELB
            * Auto scaling Instances with ELB and autoscaling group
            */
            if($key === 'ASELB'){

                //@to-do:
                //replace "HealthCheck"

                //add ASELB Sbunets (subnet ids)
                if(!empty($configuration->provision->load_balancer->subnets)){
                    $lbsubnets = preg_replace('/\s+/', '', $configuration->provision->load_balancer->subnets);
                    $lbsubnets = explode(",", $lbsubnets);
                    $lbsubnetsRef = [];
                    foreach($lbsubnets as $lbsubnet){
                        array_push($lbsubnetsRef, ['Ref' => ['RefLogicalID'=>$lbsubnet, 'NoSuffix'=>true]]);
                    }
                    $this->replaceResourceProperty($format,'ASELB',$flag,
                        [
                            'Subnets' => $lbsubnetsRef
                        ]
                    );
                }

                //add ELB Security groups
                if(!empty($configuration->provision->load_balancer->security_groups)){
                    $this->replaceResourceProperty($format,'ASELB',$flag,
                        [
                            "SecurityGroups" => [
                                [
                                    "Ref" => [
                                        "RefLogicalID" => $configuration->provision->load_balancer->security_groups,
                                        "NoSuffix" => true
                                    ]
                                ]
                            ]
                        ]
                    );
                }

                //add Certificate on port 443
                if(!empty($configuration->provision->load_balancer->listeners)){
                    foreach($configuration->provision->load_balancer->listeners as $listener){
                        if($listener->Protocol == 'HTTPS' || $listener->Protocol == 'SSL'){
                            $update = $format->Resources->$LogicalID->Properties;
                            array_push($update['Listeners'], [
                                "InstancePort" => $listener->InstancePort,
                                "LoadBalancerPort" => $listener->LoadBalancerPort,
                                "Protocol" => $listener->Protocol,
                                "SSLCertificateId" => [
                                    "Ref" => "ACMCert"
                                ]
                            ]);
                            $this->replaceResourceProperty($format,'ASELB',$flag,
                                $update
                            );
                            $key_assoc = "ACMCert".$this->getLogicalId($flag);
                            $format->Resources->$key_assoc = (object) CFResources::MAPPINGS_RESOURCE["ACMCert"];
                            $this->replaceResourceProperty($format,"ACMCert",$flag,
                                [
                                    "DomainName" => $listener->cert_domain,
                                    "DomainValidationOptions" => [
                                        [
                                            "DomainName" => $listener->cert_domain,
                                            "ValidationDomain" => $listener->cert_domain
                                        ]
                                    ]
                                ]
                            );
                        }
                    }

                }

            }

            /*
            * Bastion Host Instance
            * Single/Multiple Instance
            */
            if($key === 'BastionInstance'){

                //@to-do:
                //replace CFParams InstanceType to $configuration->provision->instance_type

                //removes the old Resource item by LogicalID
                unset($format->Resources->$LogicalID);

                $i = 0;
                while ($i < $configuration->provision->instance_count) {
                    $LogicalID_update = "BastionInstance" . $i . $this->getLogicalId($flag); //insert new LogicalID
                    $format->Resources->$LogicalID_update = (object) CFResources::MAPPINGS_RESOURCE["BastionInstance"]; //copy the Resource item

                    //add public subnet property
                    //@todo: ${use(flag.Web01.provision.subnet)} find $flag "Web01" of that public subnet,
                    //then add to 'Ref' here, and 'NoSuffix' to true
                    $update = $format->Resources->$LogicalID_update->Properties;
                    $update['NetworkInterfaces'][0]['SubnetId']['Ref'] = [ 'RefLogicalID' => 'SubnetWeb01', 'NoSuffix' => true ];
                    $this->replaceResourceProperty($format,'BastionInstance'.$i,$flag,
                        $update
                    );
                    //if enable keypair, need explicitely create a KeyPair first
                    if($configuration->provision->keypair){
                        //@todo: create KeyPair
                        //pass KeyPairName to CFParams::KeyPairName.$flag
                        $this->replaceResourceProperty($format,'BastionInstance'.$i,$flag,
                            [
                                'KeyName' => $template_id.'-'.$flag
                            ]
                        );
                    }
                    $i++;
                }

            }

            // Generate PEM key for accessing this Stack, and store private key onto S3 [EE]
            // keypairs are "layer" based, unique id is $flag. That means different layers should have different keypair.
            if(in_array($key, ["EC2Instance","ASLaunchConfiguration","BastionInstance"])){

                if($configuration->provision->keypair){
                    extract($this->awsSdkFactory->createClientByVendor(['ec2'], (array)($configuration->vendor->aws))); // Initialize the cf & ec2 client on user's behalf
                    $keypairs = $ec2->describeKeyPairs(['DryRun' => false])->toArray()['KeyPairs'];
                    $allkeypairs = [];
                    foreach($keypairs as $keypair){
                        array_push($allkeypairs,$keypair['KeyName']);
                    }
                    if(!in_array($template_id.'-'.$flag,$allkeypairs)){
                        $key = $ec2->createKeyPair(['DryRun' => false, 'KeyName' => $template_id.'-'.$flag])->toArray();
                    }
                }
            }
        }

        return $this->finalizeFormat($format,$flag);
    }

    /**
     * Finalizes each $configuration layer section for CFTemplate. Set of steps to be scheduled here:
     *  1) Add suffix to Resources' keys
     * @param string $format Cloudformation template body in Json format
     * @param string $flag the flag name of each configuration
     * @return void
     */
    protected function finalizeFormat($format,$flag){
        return $this->addResourceRefSuffix($format,$flag);
    }

    /**
     * set (overwrite) the Resources->$key's properties section into CloudFormation Template
     * @param string $format Cloudformation template body in Json format
     * @param string $key key value of array CFParams::MAPPINGS_RESOURCE
     * @param mixed $property the properties value of current resource
     * @return void
     */
    protected function setCFResourceProperties($format, $key, $property){
        $format->Resources->$key->Properties = $property;
        return $format;
    }

    /**
     * converts ALM Template syntax name to the CloudFormation defined syntax
     * @param object $syntax ALM Template syntax
     * @return string
     */
    protected function convertSyntax($syntax){

        $syntax = json_decode(json_encode($syntax, JSON_UNESCAPED_SLASHES),true);
        foreach(CFSyntax::MAPPINGS_SYNTAX as $key => $value){
            $syntax = $this->seekAndReplace($syntax, $key, $value);
        }

        return json_decode(json_encode($syntax, JSON_UNESCAPED_SLASHES));

    }


    //helper function, add suffix $flag to the end of each Resource property
    //special case, if "NoSuffix" = true, then don't add suffix and remove this key
    protected function addResourceRefSuffix($format,$flag){
        foreach ($format->Resources as $key => $value) {
            if(empty($format->Resources->$key->Flag) && (is_array($value->Properties) || is_object($value->Properties))){
                $format->Resources->$key->Properties = $this->seekAndReplaceValue($value->Properties,"Ref",$flag);
                $format->Resources->$key->Flag = $flag;
            }
        }
        return $format;
    }

    //helper function, renames the key of each array element
    protected function seekAndReplace($haystack, $needle, $new){
        foreach($haystack as $key => $value){
            if($key === $needle){
                $output[$new] = $value;
            }elseif(is_array($value)){
                $output[$key] = $this->seekAndReplace($value, $needle, $new);
            }else{
                $output[$key] = $value;
            }
        }
        return $output;
    }

    //helper function, renames the value of each array element found by key
    protected function seekAndReplaceValue($haystack, $needle, $flag){
        foreach($haystack as $key => $value){
            if($key === $needle){
                if(!in_array($value,CFResources::MAPPINGS_FLAG_FILTER)){
                    if(is_array($value) && $value["NoSuffix"]){
                        $output[$key] = $value['RefLogicalID']; //removes the "NoSuffix" indicator, and re-assign value
                    }else{
                        $output[$key] = $value.$flag;
                    }
                }else{
                    $output[$key] = $value;
                }
            }elseif(is_array($value) && !in_array($key,['AWS::CloudFormation::Init','Fn::Base64','Fn::Join'],true)){
                $output[$key] = $this->seekAndReplaceValue($value, $needle, $flag);
            }else{
                $output[$key] = $value;
            }
        }
        return $output;
    }

    //helper function, change $flag into Logical ID, A-Za-z0-9 only
    protected function getLogicalId($name){
        return preg_replace("/[^a-zA-Z0-9]+/", "", $name);
    }

    //helper function, add/replace $format resource property value
    protected function replaceResourceProperty($format,$key,$flag,$array){
        $k = $key.$this->getLogicalId($flag);
        $updated = $format->Resources->$k->Properties;
        foreach ($array as $key => $value) {
            if(is_array($updated)){
                $updated[$key] = $value;
            }
            if(is_object($updated)){
                $updated->$key = $value;
            }
        }
        return $format->Resources->$k->Properties = $updated;
    }


    protected function getUserData($LogicalID,$handler){
        empty($alm_agent = getenv(ENV_ALM_AGENT_TAG)) ? $alm_agent = 'develop' : "";
        return [
            "#!/bin/bash -v\n",
            "# Helper function\n",
            "function error_exit\n",
            "{\n",
            "  /opt/aws/bin/cfn-signal -e 1 -r \"$1\" \"",
            [
                "Ref" => "$handler"
            ],
            "\"\n",
            "  exit 1\n",
            "}\n",
            "mkdir -p /opt/mobingi/alm-agent /opt/mobingi/etc\n",
            "wget https://download.labs.mobingi.com/alm-agent/".$alm_agent. "/current/alm-agent.tgz\n",
            "tar xvzf alm-agent.tgz -C /opt/mobingi/alm-agent\n",
            "ln -sf /opt/mobingi/alm-agent/v* /opt/mobingi/alm-agent/current\n",
            "# Run init meta\n",
            "/opt/aws/bin/cfn-init -s ",
            [
                "Ref" => "AWS::StackId"
            ],
            " -r ",
            "$LogicalID",
            " ",
            " --region ",
            [
                "Ref" => "AWS::Region"
            ],
            " || error_exit 'Failed to run cfn-init'\n",
            "service docker start\n",
            "chkconfig docker on\n",
            "echo \"nameserver 8.8.8.8\" >> /etc/resolv.conf\n",
            "echo \"nameserver 8.8.4.4\" >> /etc/resolv.conf\n",
            "# All is well so signal success\n",
            "/opt/aws/bin/cfn-signal -e 0 -r \"Setup complete\" \"",
            [
                "Ref" => "$handler"
            ],
            "\"\n",
            "/opt/mobingi/alm-agent/current/alm-agent -P aws register\n"
        ];

    }


    protected function getMetaData($extra){

        return [
            "AWS::CloudFormation::Init" => [
                "config" => [
                    "commands" => (object)[],
                    "files" => [
                        "/opt/mobingi/etc/alm-agent.cfg" => [
                            "content" => '{"UserId": "'.$extra['UserId'].'","StackId": "'.$extra['StackId'].'","APIHost": "'.$extra['APIHost'].'","AuthorizationToken": "'.$extra['AuthorizationToken'].'","Flag": "'.$extra['Flag'].'"}',
                            "group" => "root",
                            "mode" => "000700",
                            "owner" => "root"
                        ],
                        "/opt/mobingi/etc/instance_lifecycle" => [
                            "content" => $extra['Lifecycle'],
                            "group" => "root",
                            "mode" => "000700",
                            "owner" => "root"
                        ]
                    ],
                    "packages" => [
                        "yum" => [
                            "docker" => [],
                            "git" => []
                        ]
                    ],
                    "services" => [
                        "sysvinit" => (object)[]
                    ]
                ]
            ]
        ];

    }
}
