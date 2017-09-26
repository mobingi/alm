<?php
namespace Mobingi\Alm\Template;
use Mobingi\Alm\Template\Mappers\Aws\CloudFormationTemplates as CFTemplates;
use Mobingi\Alm\Template\Mappers\Aws\CloudFormationResources as CFResources;
use Mobingi\Alm\Template\Traits\ConvertTrait;
use Mobingi\Core\ClientBase;
/**
 * Template Convert Client
 * @package Mobingi\Alm\Template
 */
class Convert extends ClientBase {
    /**
     * Traits
     */
    use ConvertTrait;

    /**
     * {@inheritdoc}
     */
    protected function initClients() {}

    /**
     * Converts the Alm template into CloudFormation Template format
     * @param array $configurations configuration found in template body
     * @param string $template_id ID of current template associated with stack
     * @param array $extra extra infos needs to pass to CloudFormation
     * @return void
     */
    public function convertToCFTemplate($template, $template_id, $vendor, $extra = null){

        $cred = $template->vendor->$vendor;
        $configurations = $template->configurations;

        //read and set default $format
        $format = json_decode(CFTemplates::BASE_TEMPLATE);

        //add description to CF template
        $format->Description = $template->description;

        //add default CF Parameters (required by Mobingi ALM)
        $this->appendCFTemplateParameters($format, [
            // "StackId","UserId","APIHost","AuthorizationToken","LogBucket","Flag","StorageService"
        ],'');


        //add default CF Resources for VPC (required if creating a new VPC)
        foreach(CFResources::MAPPINGS_VPC_DEFAULT as $key => $value){
            $format->Resources->$value = (object) CFResources::MAPPINGS_RESOURCE[$value];
        }

        //handle over $configurations layers
        foreach($configurations as $configuration){

            switch ($configuration->role) {
                /*
                * 'web' role:
                * general web servers
                * single instance or multiple instances with or without Load-balancer and/or auto-scaling group, supports Mobingi Spot Optimizer (@reference https://mobingi.com/solutions/spot)
                */
                case 'web':

                    //add default CF Parameters section for 'web' role
                    $this->appendCFTemplateParameters($format, [
                        "InstanceType","MachineVolumeSize"
                    ], $configuration->flag);



                    //add default CF Resources section for 'web' role
                    $this->appendCFTemplateResources($format, [
                        "NetworkAcl",
                        "NetworkAclEntry",
                        "Route",
                        "RouteTable",
                        "Subnet",
                        "EC2SecurityGroup"
                    ], $configuration, $configuration->flag);

                    //add alm-agent support if "container" section is defined
                    if(isset($configuration->container)){
                        // $this->appendCFTemplateParameters($format, [
                        //     "UserId","APIHost","AuthorizationToken","LogBucket","Flag","StorageService"
                        // ], $configuration->flag);
                        $this->appendCFTemplateResources($format, [
                            "ContainerWaitCondition",
                            "ContainerWaitConditionHandle"
                        ], $configuration, $configuration->flag);
                    }

                    if(isset($configuration->provision->auto_scaling)){
                        //add EC2 AutoScalingGroup, EC2 LaunchConfiguration, ELB CF Resources section
                        $this->appendCFTemplateResources($format, [
                            "ASAutoScalingGroup",
                            "ASLaunchConfiguration",
                            "ASELB"
                        ], $configuration, $configuration->flag, $template_id, $cred, $extra);

                    }else{
                        //add EC2 Single Instance(s) CF Resources section
                        $this->appendCFTemplateResources($format, [
                            "EC2Instance"
                        ], $configuration, $configuration->flag, $template_id, $cred, $extra);
                    }

                    break;

                /*
                * 'bastion' role:
                * a jumpbox server sits in public subnet providing ssh connections to hosts placed in private subnet (a.k.a Bastion server)
                */
                case 'bastion':

                    //add default CF Parameters section for 'web' role
                    $this->appendCFTemplateParameters($format, [
                        "InstanceType","KeyPairName"
                    ], $configuration->flag);

                    //add default CF Resources section for 'web' role
                    $this->appendCFTemplateResources($format, [
                        "BastionSecurityGroup",
                        "InternalSshSecurityGroup",
                        "BastionInstance"
                    ], $configuration, $configuration->flag, $template_id, $cred, $extra);
                    break;

                /*
                * 'nat_gateway' role:
                * A NAT gateway server. Enable NAT gateway access
                */
                case 'nat_gateway':
                    # code...
                    break;

                case 'rds':
                    # code...
                    break;

                default:
                    # code...
                    break;
            }


        }

        foreach ($format->Resources as $key => $value) {
            unset($format->Resources->$key->Flag);
        }

        return $format;
    }



    /**
     * @TBD
     * converts the Alm template into Aliyun known formats
     * @param object $configurations object configuration found in template body
     * @return void
     */
    public function convertToAliyun($configurations){
        return $configurations;
    }



}
