

### Single server {#single-server}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false
      }
    }
  ]
}
```

### Single server with "Hello World" {#single-server-with-hello-world}
```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false,
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "availability_zone": "ap-northeast-1c"
      },
      "container": {
          "image": "mobingi/ubuntu-apache2-php7:7.1",
          "codeDir": "/var/www/html",
          "gitRepo": "https://github.com/mobingilabs/default-site-php.git",
          "gitReference": "master",
          "ports": [80]
      }
    }
  ]
}
```

### Single server with custom _Subnet_ {#single-server-with-custom-subnet}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": true,
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "availability_zone": "ap-northeast-1c"
      }
    }
  ]
}
```


### Single server with custom _Network ACL_ {#single-server-with-custom-network-acl}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false,
        "network_acl": [
          {
            "RuleNumber": 100,
            "Protocol": "-1",
            "RuleAction": "allow",
            "Egress": true,
            "CidrBlock": "0.0.0.0/0"
          },
          {
            "RuleNumber": 100,
            "Protocol": "-1",
            "RuleAction": "allow",
            "Egress": false,
            "CidrBlock": "0.0.0.0/0"
          }
        ]
      }
    }
  ]
}
```


### Single server with custom _Security Group_ {#single-server-with-custom-security-group}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false,
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "security_group": {
          "ingress": [
            {
              "CidrIp": "0.0.0.0/0",
              "FromPort": 80,
              "IpProtocol": "tcp",
              "ToPort": 80
            },
            {
              "CidrIp": "0.0.0.0/0",
              "FromPort": 443,
              "IpProtocol": "tcp",
              "ToPort": 443
            },
            {
              "CidrIp": "0.0.0.0/0",
              "FromPort": 4243,
              "IpProtocol": "tcp",
              "ToPort": 4243
            },
            {
              "CidrIp": "0.0.0.0/0",
              "FromPort": 22,
              "IpProtocol": "tcp",
              "ToPort": 22
            }
          ],
          "egress": [
            {
              "CidrIp": "0.0.0.0/0",
              "FromPort": 0,
              "IpProtocol": "-1",
              "ToPort": 65535
            }
          ]
        }
      }
    }
  ]
}
```


### Single server {#single-server}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false,
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "availability_zone": "ap-northeast-1c"
      }
    }
  ]
}
```

### Load-balanced Server Stack {#load-balanced}

```json
{
  "version": "2017-03-03",
  "label": "template_01",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "secret": "change this to your AWS Security Key Secret",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Web01",
      "provision": {
        "instance_type": "m3.medium",
        "keypair": true,
        "subnet": {
          "cidr": "10.0.2.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "auto_scaling": {
          "min": 2,
          "max": 4,
          "cooldown": "360",
          "healthcheck_grace_period": "360",
          "availability_zones": "ap-northeast-1c"
        },
        "load_balancer": {
          "scheme": "internet-facing",
          "listeners": [
            {
              "LoadBalancerPort": "80",
              "InstancePort": "80",
              "Protocol": "HTTP"
            }
          ],
          "health_check": {
            "HealthyThreshold": "2",
            "Interval": "10",
            "Target": "TCP:80",
            "Timeout": "5",
            "UnhealthyThreshold": "10"
          }
        }
      },
      "container": {
        "image": "mobingi/ubuntu-apache2-php7:7.1",
        "codeDir": "/var/www/html",
        "gitRepo": "https://github.com/mobingilabs/default-site-php.git",
        "gitReference": "master",
        "ports": [
          80
        ]
      }
    }
  ]
}
```
