## vpc_id {#vpc_id}

Reserved key name.

## availability_zone {#availability_zone}

The availability zone of which the stack is deployed to.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | us-east-1 | Yes  | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    #### AWS
    ```
    (North Virginia)
    us-east-1a
    us-east-1b
    us-east-1c
    us-east-1d
    us-east-1e

    (Ohio)
    us-east-2a
    us-east-2b
    us-east-2c

    (North Carolina)
    us-west-1b
    us-west-1c

    (Oregon)
    us-west-2a
    us-west-2b
    us-west-2c

    (Canada)
    ca-central-1a
    ca-central-1b

    (Ireland)
    eu-west-1a
    eu-west-1b
    eu-west-1c

    (Frankfurt)
    eu-central-1a
    eu-central-1b

    (London)
    eu-west-2a
    eu-west-2b

    (Singapore)
    ap-southeast-1a
    ap-southeast-1b

    (Sydney)
    ap-southeast-2a
    ap-southeast-2b
    ap-southeast-2c

    (Seoul)
    ap-northeast-2a
    ap-northeast-2c

    (Tokyo)
    ap-northeast-1a
    ap-northeast-1c

    (Mumbai)
    ap-south-1a
    ap-south-1b

    (Sao Paulo)
    sa-east-1a
    sa-east-1b
    sa-east-1c
    ```
    #### AliCloud
    ```
    ap-northeast-1 [default]
    ```
    #### K5
    ```
    jp-east-1 [default]
    ```

## instance_type {#instance_type}

The type of instances (VMs).

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | t2.micro | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    #### AWS
    ```
    t2.nano
    t2.micro [default]
    t2.small
    t2.medium
    t2.large
    t2.xlarge
    t2.2xlarge
    m4.large
    m4.xlarge
    m4.2xlarge
    m4.4xlarge
    m4.10xlarge
    m4.16xlarge
    m3.medium
    m3.large
    m3.xlarge
    m3.2xlarge
    c5.large
    c5.xlarge
    c5.2xlarge
    c5.4xlarge
    c5.9xlarge
    c5.18xlarge
    c4.large
    c4.xlarge
    c4.2xlarge
    c4.4xlarge
    c4.8xlarge
    c3.large
    c3.xlarge
    c3.2xlarge
    c3.4xlarge
    c3.8xlarge
    x1.16large
    x1.32xlarge
    x1e.xlarge
    x1e.2xlarge
    x1e.4xlarge
    x1e.8xlarge
    x1e.16xlarge
    x1e.32xlarge
    r4.large
    r4.xlarge
    r4.2xlarge
    r4.4xlarge
    r4.8xlarge
    r4.16xlarge
    r3.large
    r3.xlarge
    r3.2xlarge
    r3.4xlarge
    r3.8xlarge
    p3.2xlarge
    p3.8xlarge
    p3.16xlarge
    p2.xlarge
    p2.8xlarge
    p2.16xlarge
    g3.4xlarge
    g3.8xlarge
    g3.16xlarge
    f1.2xlarge
    f1.16xlarge
    i3.large
    i3.xlarge
    i3.2xlarge
    i3.4xlarge
    i3.8xlarge
    i3.16large
    d2.xlarge
    d2.2xlarge
    d2.4xlarge
    d2.8xlarge
    ```
    #### AliCloud
    ```
    xn4.small [default]
    ```
    #### K5
    ```
    1101 [default]
    ```


## instance_count {#instance_count}

Number of instances (VMs) to provision.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| int | 1 | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    ```
    Integer greater or equal to 1.
    ```

## volume_type {#volume_type}

The volume type of instance.

| Type | Example Value| Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | standard | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    #### AWS
    ```
    gp2 - General Purpose SSD [default]
    io1 - Provisioned IOPS SSD
    st1 - Throughput Optimized HDD
    sc1 - Cold HDD
    standard - Magnetic volumes
    ```

## volume_size {#volume_size}

The size of the volume, in gibibytes (GiBs).

| Type | Example Value| Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | 50 | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    #### AWS
    ```
    Constraints: 1-16384 for gp2, 4-16384 for io1, 500-16384 for st1, 500-16384 for sc1, and 1-1024 for standard (magnetic disk).

    Default volume size in GB for each volume types:

    - gp2: 50 [default]
    - io1: 50
    - st1: 500
    - sc1: 500
    - standard: 50
    ```


## keypair {#keypair}

The ssh key pair used to access instances.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| boolean | true | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values

    #### AWS
    ```
    true [default]
    false
    ```

## subnet {#subnet}

The subnet settings.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | { "cidr": "10.0.0.0/24", "public": true, "auto_assign_public_ip":true } | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

A _subnet_ section contains 3 key names.

- `cidr` (string)
  
    The IPv4 CIDR block that you want the subnet to cover (for example, "10.0.0.0/24").

    numbers, dot, back-slash only. The default value is "10.0.0.0/24".

- `public` (boolean)
  
    Defines whether this subnet is public or private.

    true [default]
    false

- `auto_assign_public_ip` (boolean)
  
    Defines whether automatically assigns a public IP when instance launched into the subnet.

    true [default]
    false


- ### Valid Values

    #### AWS
    Below is also the default `subnet` settings.
    ```
    "subnet": {
        "cidr": "10.0.0.0/24",
        "public": true,
        "auto_assign_public_ip": true
    }
    ```



## network_acl {#network_acl}

The network action control list for a virtual private cloud.

__This section supports AWS only__

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| array | see blow | No | <span class="label label-default">AWS</span> |

A _network acl_ section contains a list of network_acl entry items. Each item contains the following declaratives:

- `rule_number` (int)

    Rule number to assign to the entry, such as 100.
    ACL entries are processed in ascending order by rule number. Entries can't use the same rule number unless one is an egress rule and the other is an ingress rule.

    For more on valid values, please refer to [this guide](http://docs.aws.amazon.com/AWSEC2/latest/APIReference/API_CreateNetworkAclEntry.html) on aws documentation site.
- `protocol` (string)

    The IP protocol that the rule applies to.
    You must specify -1 or a protocol number. You can specify -1 for all protocols.

    For more on protocol numbers, please refer to [this guide](http://www.iana.org/assignments/protocol-numbers/protocol-numbers.xhtml).
- `rule_action` (string)

    Whether to allow or deny traffic that matches the rule; valid values are "allow" or "deny".

- `acl_egress` (boolean)

    Whether this rule applies to egress traffic from the subnet (true) or ingress traffic to the subnet (false).

- `cidr_block` (string)

    The IPv4 CIDR range to allow or deny, in CIDR notation (e.g., 172.16.0.0/24).



- ### Valid Values

    #### AWS
    Below is also the default `network_acl` settings.
    ```
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
    ]
    ```

For more information about network acl please refer to [AWS Documentation](http://docs.aws.amazon.com/AmazonVPC/latest/UserGuide/VPC_ACLs.html)

## security_group {#security_group}

The security groups for your virtual private cloud. Security groups are associated with network interfaces and acts as a virtual firewall that controls the traffic for one or more instances.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | See below | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

A _security group_ section contains two entry items, `ingress` and `egress`. 

- ingress (array)
- egress (array)

Each _ingress_ or _egress_ contains the following 4 declarative:

- `cidr_ip` (string)

    An IPv4 CIDR range. 
    
    (For more information on cidr calculations, there are tools like [this](http://www.subnet-calculator.com/cidr.php) to helping you get started.)

- `from_port` (int)

    Start of port range for the TCP and UDP protocols, or an ICMP type number. If you specify icmp for the IpProtocol property, you can specify -1 as a wildcard (i.e., any ICMP type number).

- `ip_protocol` (string)

    IP protocol name or number.

- `to_port` (int)

    End of port range for the TCP and UDP protocols, or an ICMP code. If you specify icmp for the IpProtocol property, you can specify -1 as a wildcard (i.e., any ICMP code).



- ### Valid Values

    #### AWS, AliCloud, K5
    Below is also the default `security_group` settings.
    ```
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
    ```

## auto_scaling {#auto_scaling}

The auto-scaling group defines the configuration to automatically scale up or down the number of compute resources that are being allocated to your application based on its needs at any given time.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | See below | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

The _auto scaling_ section contains the following declarative:


- `min` (int)
    
    The minimum size of the Auto Scaling group.
    
- `max` (int)
    
    The maximum size of the Auto Scaling group.
    
- `spot_min` (int)
    
    The minimum size of the spot instances in Auto Scaling group.
    
    _Required_: No
    
    _This declarative supports AWS only, if you specify this value when deploying to other cloud platforms it will be ignored._
    
- `spot_max` (int)
  
    The maximum size of the spot instances in Auto Scaling group.
  
- `availability_zones` (string)
  
    The maximum size of the Auto Scaling group.
  
- `security_groups` (string)
  
    The maximum size of the Auto Scaling group.

- `subnets` (string)
  
    The subnets in which the instances in the Auto Scaling group launches to.
  
- `cooldown` (string)
  
    The number of seconds after a scaling activity is completed before any further scaling activities can start.
  
- `healthcheck_grace_period` (string)
  
    The length of time in seconds after a new EC2 instance comes into service that Auto Scaling starts checking its health.





- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws">
    Below is also the default settings for AWS.
    <pre><code class="language-json">
    "auto_scaling": {
        "min": 1,
        "max": 1,
        "availability_zones": "${use(flag.Web01.provision.availability_zone)},${use(flag.Web02.provision.availability_zone)}",
        "security_groups": "${use(flag.Web01.provision.security_group)}",
        "subnets": "${ref(flag.Web01,flag.Web02)}",
        "cooldown": "360",
        "healthcheck_grace_period": "360"
    }
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud">
    This section hasn't been covered by documentation.
    <pre><code class="language-json">
    "auto_scaling": {

    }
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5">
    This section hasn't been covered by documentation.
    <pre><code class="language-json">
    "auto_scaling": {

    }
    </code></pre>
    </div>
    </div>
    </div>


## load_balancer {#load_balancer}
