

### Single server {#single-server}

```json
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
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
        "availability_zone": "ap-northeast-1c"
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
        "availability_zone": "ap-northeast-1c",
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        }
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
            "cidr_block": "0.0.0.0/0"
          },
          {
            "rule_number": 100,
            "protocol": "-1",
            "rule_action": "allow",
            "acl_egress": false,
            "cidr_block": "0.0.0.0/0"
          }
        ],
        "availability_zone": "ap-northeast-1c"
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
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "availability_zone": "ap-northeast-1c",
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

### Load-balanced Server Stack {#load-balanced}

The example below creates an elastic Load-balancer, an auto-scaling group with 2 to 4 instances placed at the same subnet in availability zone _ap-northeast-1c_.
 
```json
{
  "version": "2017-03-03",
  "label": "template_01",
  "description": "This template creates a sample stack with ELB enabled with single AZ on AWS",
  "vendor": {
    "aws": {
      "cred": "change this to your AWS Security Key ID",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Web01",
      "provision": {
        "availability_zone": "ap-northeast-1c",
        "instance_type": "m3.medium",
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
            "unhealthy_threshold": "10"
          }
        }
      }
    }
  ]
}
```

### Multi Layer Load-balanced Server Stack {#load-balanced2}

The example below creates a stack that having four application load-balancers (ALBs) with HTTPS connection and ACM SSL certificate enabled, with each pointing to two different subnets, and assigned to an auto scaling group with both on-demand and spot instances supported, together with customized security group settings.

```json
{
    "version": "2017-03-03",
    "label": "VDI Template",
    "description": "This template creates a multi ALB linking to one autoscaling group stacks with on AWS",
    "vendor": {
        "aws": {
            "cred": "change this to your AWS Security Key ID",
            "region": "ap-northeast-1"
        }
    },
    "configurations": [
        {
            "role": "web",
            "flag": "Layer1",
            "provision": {
                "instance_type": "m3.medium",
                "keypair": true,
                "security_group": {
                    "ingress": [
                        {
                            "cidr_ip": "0.0.0.0/0",
                            "from_port": 6901,
                            "ip_protocol": "tcp",
                            "to_port": 6904
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
                },
                "subnet": {
                    "cidr": "10.0.0.0/24",
                    "public": true,
                    "auto_assign_public_ip": true
                },
                "auto_scaling": {
                    "min": 3,
                    "max": 3,
                    "spot_min": 6,
                    "spot_max": 12,
                    "cooldown": "360",
                    "healthcheck_grace_period": "360",
                    "availability_zones": "ap-northeast-1a,ap-northeast-1c"
                },
                "load_balancer": {
                    "scheme": "internet-facing",
                    "security_groups": "#ref(Layer2.provision.security_group)",
                    "lb_type": "application",
                    "subnets": "#share(Layer1.provision.subnet,Layer2.provision.subnet)",
                    "listeners": [
                        {
                            "load_balancer_port": "443",
                            "instance_port": "6901",
                            "protocol": "HTTPS",
                            "instance_protocol": "HTTP",
                            "cert_domain": "*.example.com"
                        }
                    ]
                },
                "availability_zone": "ap-northeast-1a"
            },
            "container": {
                "container_image": "mobingi/ubuntu-apache2-php7:7.1",
                "container_code_dir": "/var/www/html",
                "container_git_repo": "https://github.com/mobingilabs/default-site-php.git",
                "container_git_reference": "master",
                "container_ports": [
                    80,
                    6901,
                    6902,
                    6903,
                    6904
                ]
            }
        },
        {
            "role": "web",
            "flag": "Layer2",
            "provision": {
                "instance_type": "m3.medium",
                "subnet": {
                    "cidr": "10.0.2.0/24",
                    "public": true,
                    "auto_assign_public_ip": true
                },
                "security_group": {
                    "ingress": [
                        {
                            "cidr_ip": "0.0.0.0/0",
                            "from_port": 443,
                            "ip_protocol": "tcp",
                            "to_port": 443
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
                },
                "load_balancer": {
                    "scheme": "internet-facing",
                    "lb_type": "application",
                    "security_groups": "#ref(Layer2.provision.security_group)",
                    "subnets": "#share(Layer1.provision.subnet,Layer2.provision.subnet)",
                    "listeners": [
                        {
                            "load_balancer_port": "443",
                            "instance_port": "6902",
                            "protocol": "HTTPS",
                            "instance_protocol": "HTTP",
                            "cert_domain": "*.example2.com"
                        }
                    ]
                },
                "availability_zone": "ap-northeast-1c",
                "auto_scaling": "#share(Layer1.provision.auto_scaling)"
            }
        },
        {
            "role": "web",
            "flag": "Layer3",
            "provision": {
                "instance_type": "m3.medium",
                "keypair": true,
                "subnet": {
                    "cidr": "10.0.3.0/24",
                    "public": true,
                    "auto_assign_public_ip": true
                },
                "load_balancer": {
                    "scheme": "internet-facing",
                    "security_groups": "#ref(Layer2.provision.security_group)",
                    "lb_type": "application",
                    "subnets": "#share(Layer3.provision.subnet,Layer4.provision.subnet)",
                    "listeners": [
                        {
                            "load_balancer_port": "443",
                            "instance_port": "6903",
                            "protocol": "HTTPS",
                            "instance_protocol": "HTTP",
                            "cert_domain": "*.example2.com"
                        }
                    ]
                },
                "availability_zone": "ap-northeast-1c",
                "auto_scaling": "#share(Layer1.provision.auto_scaling)"
            }
        },
        {
            "role": "web",
            "flag": "Layer4",
            "provision": {
                "instance_type": "m3.medium",
                "keypair": true,
                "subnet": {
                    "cidr": "10.0.4.0/24",
                    "public": true,
                    "auto_assign_public_ip": true
                },
                "load_balancer": {
                    "scheme": "internet-facing",
                    "lb_type": "application",
                    "subnets": "#share(Layer3.provision.subnet,Layer4.provision.subnet)",
                    "listeners": [
                        {
                            "load_balancer_port": "443",
                            "instance_port": "6904",
                            "protocol": "HTTPS",
                            "instance_protocol": "HTTP",
                            "cert_domain": "*.example2.com"
                        }
                    ],
                    "security_groups": "#ref(Layer2.provision.security_group)"
                },
                "availability_zone": "ap-northeast-1a",
                "auto_scaling": "#share(Layer1.provision.auto_scaling)"
            }
        }
    ]
}
```
