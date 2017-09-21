<?php
namespace Mobingi\Alm\Template\Mappers\Aws;
/**
 * Template Mappers CloudFormationResources
 * @package Mobingi\Alm\Template\Mappers\Aws
 */
class CloudFormationResources {

    /*
    * @note A set of default Resources required if creating a new VPC
    */
    const MAPPINGS_VPC_DEFAULT = [
        "VPC",
        "VPCInternetGateway",
        "VPCGatewayAttachment"
    ];

    /*
    * @note A set of keys in CFTemplate where shouldn't add suffix as they are unique to all layers
    */
    const MAPPINGS_FLAG_FILTER = [
        "VPC",
        "VPCInternetGateway",
        "VPCGatewayAttachment",
        "AWS::Region",
        "MobingiInstanceProfile",
        "AlmAgentPolicy",
        "MobingiAlmRole",
        "RootPolicy"
    ];

    /*
    * @note A configuration of CloudFormation Template Resource with DEFAULT properties
    * "Properties" are default values in each key set for working with Mobingin ALM, when value provided, each default "Properties" item will be overwriten
    */
    const MAPPINGS_RESOURCE = [
        "EC2Instance" => [
            "Type" => "AWS::EC2::Instance",
            "DependsOn" => ["VPCGatewayAttachment"],
            "Properties" =>
            [
                "InstanceType" => [
                    "Ref" => "InstanceType"
                ],
                "ImageId" => [
                    "Fn::FindInMap" => [
                        "Ami",
                        [
                            "Ref" => "AWS::Region"
                        ],
                        [
                            "Fn::FindInMap" => [
                                "AmiTypeMapping",
                                [
                                    "Ref" => "InstanceType"
                                ],
                                "type"
                            ]
                        ]
                    ]
                ],
                "SecurityGroupIds" => [
                    [
                        "Ref" => "EC2SecurityGroup"
                    ]
                ],
                "BlockDeviceMappings" => [
                    [
                        "DeviceName" => "/dev/xvda",
                        "Ebs" => [
                            "VolumeSize" => [
                                "Ref" => "MachineVolumeSize"
                            ]
                        ]
                    ]
                ],
                "SubnetId" => [
                    "Ref" => "Subnet"
                ]
            ]
        ],
        "EC2SecurityGroup" => [
            "Type" => "AWS::EC2::SecurityGroup",
            "Properties" =>
            //Default ALM settings for AWS Instance Security Group policy
            [
                "SecurityGroupEgress" => [
                    [
                        "CidrIp" => "0.0.0.0/0",
                        "FromPort" => "0",
                        "IpProtocol" => "-1",
                        "ToPort" => "65535"
                    ]
                ],
                "SecurityGroupIngress" => [
                    [
                        "CidrIp" => "0.0.0.0/0",
                        "FromPort" => 80,
                        "IpProtocol" => "tcp",
                        "ToPort" => 80
                    ],
                    [
                        "CidrIp" => "0.0.0.0/0",
                        "FromPort" => 443,
                        "IpProtocol" => "tcp",
                        "ToPort" => 443
                    ],
                    [
                        "CidrIp" => "0.0.0.0/0",
                        "FromPort" => 22,
                        "IpProtocol" => "tcp",
                        "ToPort" => 22
                    ]
                ],
                "VpcId" => [
                    "Ref" => "VPC"
                ],
                "GroupDescription" => "Mobingi Generated Security Group"
            ]
        ],
        "ASAutoScalingGroup" => [
            "Type" => "AWS::AutoScaling::AutoScalingGroup",
            "DependsOn" => ["VPCGatewayAttachment"],
            "Properties" =>
            //Default ALM settings for AWS AutoScaling AutoScalingGroup
            [
                // "AvailabilityZones" => [
                //     "Fn::GetAZs" => ""
                // ],
                "VPCZoneIdentifier" => [
                    [
                        "Ref" => "Subnet"
                    ]
                ],
                "LaunchConfigurationName" => [
                    "Ref" => "ASLaunchConfiguration"
                ],
                "MinSize" => "1",
                "MaxSize" => "1",
                "Cooldown" => "360",
                "HealthCheckGracePeriod" => "360",
                "LoadBalancerNames" => [
                    [
                        "Ref" => "ASELB"
                    ]
                ]
            ]
        ],
        "ASSpotAutoScalingGroup" => [
            "Type" => "AWS::AutoScaling::AutoScalingGroup",
            "DependsOn" => ["VPCGatewayAttachment"],
            "Properties" =>
            //Default ALM settings for AWS AutoScaling AutoScalingGroup
            [
                "AvailabilityZones" => [
                    "Fn::GetAZs" => ""
                ],
                "VPCZoneIdentifier" => [
                    [
                        "Ref" => "Subnet"
                    ]
                ],
                "LaunchConfigurationName" => [
                    "Ref" => "ASSpotLaunchConfiguration"
                ],
                "MinSize" => "1",
                "MaxSize" => "1",
                "Cooldown" => "360",
                "HealthCheckGracePeriod" => "360",
                "LoadBalancerNames" => [
                    [
                        "Ref" => "ASELB"
                    ]
                ]
            ]
        ],
        "ASLaunchConfiguration" => [
            "Type" => "AWS::AutoScaling::LaunchConfiguration",
            "Properties" =>
            //Default ALM settings for AWS AutoScaling AutoScalingGroup
            [
                "AssociatePublicIpAddress" => "true",
                "InstanceType" => [
                    "Ref" => "InstanceType"
                ],
                "BlockDeviceMappings" => [
                    [
                        "DeviceName" => "/dev/xvda",
                        "Ebs" => [
                            "VolumeSize" => [
                                "Ref" => "MachineVolumeSize"
                            ]
                        ]
                    ]
                ],
                "ImageId" => [
                    "Fn::FindInMap" => [
                        "Ami",
                        [
                            "Ref" => "AWS::Region"
                        ],
                        [
                            "Fn::FindInMap" => [
                                "AmiTypeMapping",
                                [
                                    "Ref" => "InstanceType"
                                ],
                                "type"
                            ]
                        ]
                    ]
                ],
                "SecurityGroups" => [
                    [
                        "Ref" => "EC2SecurityGroup"
                    ]
                ]
            ]
        ],
        "ASSpotLaunchConfiguration" => [
            "Type" => "AWS::AutoScaling::LaunchConfiguration",
            "Properties" =>
            //Default ALM settings for AWS AutoScaling AutoScalingGroup
            [
                "AssociatePublicIpAddress" => "true",
                "InstanceType" => [
                    "Ref" => "InstanceType"
                ],
                "BlockDeviceMappings" => [
                    [
                        "DeviceName" => "/dev/xvda",
                        "Ebs" => [
                            "VolumeSize" => [
                                "Ref" => "MachineVolumeSize"
                            ]
                        ]
                    ]
                ],
                "ImageId" => [
                    "Fn::FindInMap" => [
                        "Ami",
                        [
                            "Ref" => "AWS::Region"
                        ],
                        [
                            "Fn::FindInMap" => [
                                "AmiTypeMapping",
                                [
                                    "Ref" => "InstanceType"
                                ],
                                "type"
                            ]
                        ]
                    ]
                ],
                "SecurityGroups" => [
                    [
                        "Ref" => "EC2SecurityGroup"
                    ]
                ],
                "SpotPrice" => [
                    "Ref" => "SpotPrice"
                ]
            ]
        ],
        "ASELB" => [
            "Type" => "AWS::ElasticLoadBalancing::LoadBalancer",
            "DependsOn" => ["VPCGatewayAttachment"],
            "Properties" =>
            //Default ALM settings for AWS AutoScaling AutoScalingGroup
            [
                "HealthCheck" => [
                    "HealthyThreshold" => "2",
                    "Interval" => "10",
                    "Target" => "TCP:80",
                    "Timeout" => "5",
                    "UnhealthyThreshold" => "10"
                ],
                "Listeners" => [
                    [
                        "InstancePort" => "80",
                        "LoadBalancerPort" => "80",
                        "Protocol" => "HTTP"
                    ]
                ],
                "SecurityGroups" => [
                    [
                        "Ref" => "EC2SecurityGroup"
                    ]
                ],
                "Subnets" => [
                    [
                        "Ref" => "Subnet"
                    ]
                ]
                //@todo
                // "LBCookieStickinessPolicy" => [],
                // "CrossZone" => [],
                // "Policies" => [],
                // "Scheme" => [],
            ]
        ],
        "VPC" => [
            "Type" => "AWS::EC2::VPC",
            "Properties" =>
            [
                "CidrBlock" => "10.0.0.0/16",
                "EnableDnsSupport" => true,
                "EnableDnsHostnames" => true,
                "InstanceTenancy" => "default",
            ]
        ],
        "VPCInternetGateway" => [
            "Type" => "AWS::EC2::InternetGateway"
        ],
        "VPCGatewayAttachment" => [
            "Type" => "AWS::EC2::VPCGatewayAttachment",
            "Properties" => [
                "InternetGatewayId" => [
                    "Ref" => "VPCInternetGateway"
                ],
                "VpcId" => [
                    "Ref" => "VPC"
                ]
            ]
        ],
        "NetworkAcl" => [
            "Type" => "AWS::EC2::NetworkAcl",
            "Properties" =>
            [
                "VpcId" => [
                    "Ref" => "VPC"
                ]
            ]
        ],
        "NetworkAclEntry" => [
            "Type" => "AWS::EC2::NetworkAclEntry",
            "Properties" =>
            [
                "CidrBlock" => "0.0.0.0/0",
                "Egress" => "true",
                "NetworkAclId" => [
                    "Ref" => "NetworkAcl"
                ],
                "Protocol" => "-1",
                "RuleAction" => "allow",
                "RuleNumber" => "100"
            ]
        ],
        "SubnetRouteTableAssociation" => [
            "Type" => "AWS::EC2::SubnetRouteTableAssociation",
            "Properties" => [
                "SubnetId" => [
                    "Ref" => "Subnet"
                ],
                "RouteTableId" => [
                    "Ref" => "RouteTable"
                ]
            ]
        ],
        "RouteTable" => [
            "Type" => "AWS::EC2::RouteTable",
            "Properties" => [
                "VpcId" => [
                    "Ref" => "VPC"
                ]
            ]
        ],
        "Route" => [
            "Type" => "AWS::EC2::Route",
            "Properties" => [
                "GatewayId" => [
                    "Ref" => "VPCInternetGateway"
                ],
                "RouteTableId" => [
                    "Ref" => "RouteTable"
                ],
                "DestinationCidrBlock" => "0.0.0.0/0"
            ]
        ],
        // "Subnet" => [
        //     "Type" => "AWS::EC2::Subnet",
        //     "Properties" =>
        //     [
        //         "AvailabilityZone" => "",
        //         "CidrBlock" => "10.0.1.0/24",
        //         "MapPublicIpOnLaunch" => true,
        //         "VpcId" => [
        //             "Ref" => "VPC"
        //         ]
        //     ]
        // ],
        "BastionInstance" => [
            "Type" => "AWS::EC2::Instance",
            "DependsOn" => ["VPCGatewayAttachment"],
            "Properties" =>
            [
                "InstanceType" => [
                    "Ref" => "InstanceType"
                ],
                "ImageId" => [
                    "Fn::FindInMap" => [
                        "AmiBastion",
                        [
                            "Ref" => "AWS::Region"
                        ],
                        [
                            "Fn::FindInMap" => [
                                "AmiTypeMapping",
                                [
                                    "Ref" => "InstanceType"
                                ],
                                "type"
                            ]
                        ]
                    ]
                ],
                "NetworkInterfaces" => [
                    [
                        "GroupSet" => [
                            [ "Ref" => "BastionSecurityGroup" ]
                        ],
                        "AssociatePublicIpAddress" => "true",
                        "DeviceIndex" => "0",
                        "DeleteOnTermination" => "true",
                        "SubnetId" => [
                            "Ref" => "Subnet"
                        ]
                    ]
                ]
            ]
        ],
        "BastionSecurityGroup" => [
            "Type" => "AWS::EC2::SecurityGroup",
            "Properties" =>
            //Default ALM settings for Bastion Security Group policy
            [
                "SecurityGroupIngress" => [
                    [
                        "CidrIp" => "0.0.0.0/0",
                        "FromPort" => 22,
                        "IpProtocol" => "tcp",
                        "ToPort" => 22
                    ]
                ],
                "VpcId" => [
                    "Ref" => "VPC"
                ],
                "GroupDescription" => "Enable access to the bastion host"
            ]
        ],
        "InternalSshSecurityGroup" => [
            "Type" => "AWS::EC2::SecurityGroup",
            "Properties" =>
            //Default ALM settings for allowing ssh connection from Bastion server
            [
                "SecurityGroupIngress" => [
                    [
                        "SourceSecurityGroupId" => [
                            "Ref" => "BastionSecurityGroup"
                        ],
                        "FromPort" => 22,
                        "IpProtocol" => "tcp",
                        "ToPort" => 22
                    ]
                ],
                "VpcId" => [
                    "Ref" => "VPC"
                ],
                "GroupDescription" => "Allow SSH access from bastion"
            ]
        ],
        "ACMCert" => [
            "Type" => "AWS::CertificateManager::Certificate",
            "Properties" =>
            [
                "DomainName" => "example.com",
                "DomainValidationOptions" => [
                    [
                        "DomainName" => "example.com",
                        "ValidationDomain" => "example.com"
                    ]
                ]
            ]
        ],
        "ContainerWaitCondition" => [
            "Type" => "AWS::CloudFormation::WaitCondition",
            "Properties" =>
            [
                "Handle" => [
                    "Ref" => "ContainerWaitConditionHandle"
                ],
                "Timeout" => 3600
            ]
        ],
        "ContainerWaitConditionHandle" => [
            "Type" => "AWS::CloudFormation::WaitConditionHandle",
        ],
        "MobingiAlmRole" => [
            "Type" => "AWS::IAM::Role",
            "Properties" =>
            [
                "AssumeRolePolicyDocument" => [
                    "Version" => "2012-10-17",
                    "Statement" => [
                        [
                            "Effect" => "Allow",
                            "Principal" => [
                                "Service" => [
                                    "ec2.amazonaws.com"
                                ]
                            ],
                            "Action" => [
                                "sts:AssumeRole"
                            ]
                        ]
                    ]
                ],
                "Path" => "/"
            ]
        ],
        "RootPolicy" => [
            "Type" => "AWS::IAM::Policy",
            "Properties" =>
            [
                "PolicyDocument" => [
                    "Version" => "2012-10-17",
                    "Statement" => [
                        [
                            "Effect" => "Allow",
                            "Action" => "*",
                            "Resource" => "*"
                        ]
                    ]
                ],
                "Roles" => [
                    [
                        "Ref" => "MobingiAlmRole"
                    ]
                ],
                "PolicyName" => "root"
            ]
        ],
        "AlmAgentPolicy" => [
            "Type" => "AWS::IAM::Policy",
            "Properties" =>
            [
                "PolicyDocument" => [
                    "Version" => "2012-10-17",
                    "Statement" => [
                        [
                            "Effect" => "Allow",
                            "Action" => [
                                "autoscaling:DescribeAutoScalingInstances",
                                "autoscaling:CompleteLifecycleAction",
                                "cloudformation:DescribeStackResource",
                                "cloudformation:DescribeStackResources",
                                "elasticloadbalancing:DeregisterInstancesFromLoadBalancer"
                            ],
                            "Resource" => [
                                "*"
                            ]
                        ]
                    ]
                ],
                "Roles" => [
                    [
                        "Ref" => "MobingiAlmRole"
                    ]
                ],
                "PolicyName" => "alm-agent"
            ]
        ],
        "MobingiInstanceProfile" => [
            "Type" => "AWS::IAM::InstanceProfile",
            "Properties" =>
            [
                "Roles" => [
                    [
                        "Ref" => "MobingiAlmRole"
                    ]
                ],
                "Path" => "/"
            ]
        ]

    ];



}
