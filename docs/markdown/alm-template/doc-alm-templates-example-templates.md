

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
          "container_image": "mobingi/ubuntu-apache2-php7:7.1",
          "container_code_dir": "/var/www/html",
          "container_git_repo": "https://github.com/mobingilabs/default-site-php.git",
          "container_git_reference": "master",
          "container_ports": [80]
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
            "rule_number": 100,
            "protocol": "-1",
            "rule_action": "allow",
            "acl_egress": true,
            "cidr": "0.0.0.0/0"
          },
          {
            "rule_number": 100,
            "protocol": "-1",
            "rule_action": "allow",
            "acl_egress": false,
            "cidr": "0.0.0.0/0"
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
              "cidr_ip": "0.0.0.0/0",
              "from_port": 80,
              "ip_protocol": "tcp",
              "to_port": 80
            },
            {
              "cidr_ip": "0.0.0.0/0",
              "from_port": 443,
              "ip_protocol": "tcp",
              "to_port": 443
            },
            {
              "cidr_ip": "0.0.0.0/0",
              "from_port": 4243,
              "ip_protocol": "tcp",
              "to_port": 4243
            },
            {
              "cidr_ip": "0.0.0.0/0",
              "from_port": 22,
              "ip_protocol": "tcp",
              "to_port": 22
            }
          ],
          "egress": [
            {
              "cidr_ip": "0.0.0.0/0",
              "from_port": 0,
              "ip_protocol": "-1",
              "to_port": 65535
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
              "load_balancer_port": "80",
              "instance_port": "80",
              "protocol": "HTTP"
            }
          ],
          "health_check": {
            "healthy_threshold": "2",
            "interval": "10",
            "target": "TCP:80",
            "timeout": "5",
            "UnhealthyThreshold": "10"
          }
        }
      },
      "container": {
        "container_image": "mobingi/ubuntu-apache2-php7:7.1",
        "container_code_dir": "/var/www/html",
        "container_git_repo": "https://github.com/mobingilabs/default-site-php.git",
        "container_git_reference": "master",
        "container_ports": [
          80
        ]
      }
    }
  ]
}
```
