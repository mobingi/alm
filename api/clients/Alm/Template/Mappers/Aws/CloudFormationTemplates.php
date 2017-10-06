<?php
namespace Mobingi\Alm\Template\Mappers\Aws;
/**
 * Template Mappers CloudFormationTemplates
 * @package Mobingi\Alm\Template\Mappers\Aws
 */
class CloudFormationTemplates {

    const BASE_TEMPLATE = '
    {
      "AWSTemplateFormatVersion": "2010-09-09",
      "Description": "",
      "Mappings": {
        "Ami": {
          "ap-northeast-1": {
            "HVM64": "ami-2a69be4c"
          },
          "ap-northeast-2": {
            "HVM64": "ami-9bec36f5"
          },
          "ap-southeast-1": {
            "HVM64": "ami-0797ea64"
          },
          "ap-southeast-2": {
            "HVM64": "ami-8536d6e7"
          },
          "eu-central-1": {
            "HVM64": "ami-c7ee5ca8"
          },
          "eu-west-1": {
            "HVM64": "ami-acd005d5"
          },
          "sa-east-1": {
            "HVM64": "ami-f1344b9d"
          },
          "us-east-1": {
            "HVM64": "ami-8c1be5f6"
          },
          "us-west-1": {
            "HVM64": "ami-02eada62"
          },
          "us-west-2": {
            "HVM64": "ami-e689729e"
          }
        },
        "AmiBastion": {
          "ap-northeast-1": {
            "HVM64": "ami-2a69be4c"
          },
          "ap-northeast-2": {
            "HVM64": "ami-9bec36f5"
          },
          "ap-south-1": {
            "HVM64": "ami-4fc58420"
          },
          "ap-southeast-1": {
            "HVM64": "ami-0797ea64"
          },
          "ap-southeast-2": {
            "HVM64": "ami-8536d6e7"
          },
          "ca-central-1": {
            "HVM64": "ami-fd55ec99"
          },
          "eu-central-1": {
            "HVM64": "ami-c7ee5ca8"
          },
          "eu-west-1": {
            "HVM64": "ami-acd005d5"
          },
          "eu-west-2": {
            "HVM64": "ami-1a7f6d7e"
          },
          "sa-east-1": {
            "HVM64": "ami-f1344b9d"
          },
          "us-east-1": {
            "HVM64": "ami-8c1be5f6"
          },
          "us-east-2": {
            "HVM64": "ami-c5062ba0"
          },
          "us-west-1": {
            "HVM64": "ami-02eada62"
          },
          "us-west-2": {
            "HVM64": "ami-e689729e"
          }
        },
        "AmiTypeMapping": {
          "c3.2xlarge": {
            "type": "HVM64"
          },
          "c3.4xlarge": {
            "type": "HVM64"
          },
          "c3.8xlarge": {
            "type": "HVM64"
          },
          "c3.large": {
            "type": "HVM64"
          },
          "c3.xlarge": {
            "type": "HVM64"
          },
          "c4.2xlarge": {
            "type": "HVM64"
          },
          "c4.4xlarge": {
            "type": "HVM64"
          },
          "c4.8xlarge": {
            "type": "HVM64"
          },
          "c4.large": {
            "type": "HVM64"
          },
          "c4.xlarge": {
            "type": "HVM64"
          },
          "cc2.8xlarge": {
            "type": "HVM64"
          },
          "cr1.8xlarge": {
            "type": "HVM64"
          },
          "g2.2xlarge": {
            "type": "HVM64"
          },
          "hi1.4xlarge": {
            "type": "HVM64"
          },
          "hs1.8xlarge": {
            "type": "HVM64"
          },
          "i2.2xlarge": {
            "type": "HVM64"
          },
          "i2.4xlarge": {
            "type": "HVM64"
          },
          "i2.8xlarge": {
            "type": "HVM64"
          },
          "i2.xlarge": {
            "type": "HVM64"
          },
          "m3.2xlarge": {
            "type": "HVM64"
          },
          "m3.large": {
            "type": "HVM64"
          },
          "m3.medium": {
            "type": "HVM64"
          },
          "m3.xlarge": {
            "type": "HVM64"
          },
          "r3.2xlarge": {
            "type": "HVM64"
          },
          "r3.4xlarge": {
            "type": "HVM64"
          },
          "r3.8xlarge": {
            "type": "HVM64"
          },
          "r3.large": {
            "type": "HVM64"
          },
          "r3.xlarge": {
            "type": "HVM64"
          },
          "t2.medium": {
            "type": "HVM64"
          },
          "t2.micro": {
            "type": "HVM64"
          },
          "t2.small": {
            "type": "HVM64"
          }
        }
      },
      "Parameters": {},
      "Resources": {},
      "Outputs": {}
    }';

}
