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
            "HVM64": "ami-4af5022c"
          },
          "ap-northeast-2": {
            "HVM64": "ami-8663bae8"
          },
          "ap-southeast-1": {
            "HVM64": "ami-fdb8229e"
          },
          "ap-southeast-2": {
            "HVM64": "ami-30041c53"
          },
          "eu-central-1": {
            "HVM64": "ami-657bd20a"
          },
          "eu-west-1": {
            "HVM64": "ami-ebd02392"
          },
          "sa-east-1": {
            "HVM64": "ami-d27203be"
          },
          "us-east-1": {
            "HVM64": "ami-4fffc834"
          },
          "us-west-1": {
            "HVM64": "ami-3a674d5a"
          },
          "us-west-2": {
            "HVM64": "ami-aa5ebdd2"
          }
        },
        "AmiBastion": {
          "ap-northeast-1": {
            "HVM64": "ami-4af5022c"
          },
          "ap-northeast-2": {
            "HVM64": "ami-8663bae8"
          },
          "ap-south-1": {
            "HVM64": "ami-d7abd1b8"
          },
          "ap-southeast-1": {
            "HVM64": "ami-fdb8229e"
          },
          "ap-southeast-2": {
            "HVM64": "ami-30041c53"
          },
          "ca-central-1": {
            "HVM64": "ami-5ac17f3e"
          },
          "eu-central-1": {
            "HVM64": "ami-657bd20a"
          },
          "eu-west-1": {
            "HVM64": "ami-ebd02392"
          },
          "eu-west-2": {
            "HVM64": "ami-489f8e2c"
          },
          "sa-east-1": {
            "HVM64": "ami-d27203be"
          },
          "us-east-1": {
            "HVM64": "ami-4fffc834"
          },
          "us-east-2": {
            "HVM64": "ami-ea87a78f"
          },
          "us-west-1": {
            "HVM64": "ami-3a674d5a"
          },
          "us-west-2": {
            "HVM64": "ami-aa5ebdd2"
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
