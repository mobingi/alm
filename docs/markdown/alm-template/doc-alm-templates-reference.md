# provision {#provision}

## vpc_id {#vpc_id}

Reserved key name.

## availability_zone {#availability_zone}

The availability zone of which the stack deploys to.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | us-east-1 | Yes  | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

You must specify this value in your Alm-template.

- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_availability_zone" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_availability_zone" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_availability_zone">
    <pre><code class="language-json">
    "availability_zone": "ap-northeast-1c"
    </code></pre>
    Below are the valid availability zones for each regions on AWS.
    <pre style="height:150px;><code class="">
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
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_availability_zone">
    This section hasn't been fully covered by documentation.
    <pre><code class="language-json">
    "availability_zone": "ap-northeast-1"
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_availability_zone">
    This section hasn't been fully covered by documentation.
    <pre><code class="language-json">
    "availability_zone": "jp-east-1"
    </code></pre>
    </div>
    </div>
    </div>


## instance_type {#instance_type}

The type of instances (VMs).

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | t2.micro | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

If you don't specify this declarative, the default values will be applied for each cloud platform. 

See below for default values.

- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_instance_type" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_instance_type" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_instance_type" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_instance_type">
    Default: <i>t2.micro</i>
    <pre><code class="language-json">
    "instance_type": "t2.micro"
    </code></pre>
    Below are the valid instance types for AWS.
    <pre style="height:150px;><code class="">
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
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_instance_type">
    Default: <i>xn4.small</i>.
    <pre><code class="language-json">
    "instance_type": "xn4.small"
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_instance_type">
    Default: <i>1101</i>.
    <pre><code class="language-json">
    "instance_type": "1101"
    </code></pre>
    </div>
    </div>





## image {#image}

The machine image (id) used to launch the instance.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | ami-2a69be4c | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

Default values will be applied for each cloud platform (see below for default values). However, you can also specify this value for launching with a customized image.

_Note:_ When you specifies this value and also specifies the _container_ section in the Alm-template to take the advantage of application lifecycle management, you need to make sure the base image operating system supports Alm-agent installation. For supported operating systems by Alm-agent, please refer to [this guide](https://learn.mobingi.com/alm-agent/getting-started#prerequisites). 



- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_image" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_image" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_image" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_image">
    Below is also the default value for AWS.
    <pre><code class="language-json">
    "image": "ami-2a69be4c"
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_image">
    Below is also the default value for Alibaba Cloud.
    <pre><code class="language-json">
    "image": "centos_7_03_64_40G_alibase_20170710.vhd"
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_image">
    Below is also the default value for K5.
    <pre><code class="language-json">
    "image": "58fd966f-b055-4cd0-9012-cf6af7a4c32b"
    </code></pre>
    </div>
    </div>




## instance_count {#instance_count}

Number of instances (VMs) to provision.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| int | 1 | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

If you don't specify this declarative, the default value of _1_ will be applied.


- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_instance_count" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_instance_count" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_instance_count" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_instance_count">
    <pre><code class="language-json">
    "instance_count": 1
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_instance_count">
    <pre><code class="language-json">
    "instance_count": 1
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_instance_count">
    <pre><code class="language-json">
    "instance_count": 1
    </code></pre>
    </div>
    </div>
    </div>

## volume_type {#volume_type}

The volume type of instance.

| Type | Example Value| Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | standard | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_volume_type" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_volume_type" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_volume_type" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_volume_type">
    If you don't specify this declarative, the default value of <i>gp2</i> will be applied.
    <pre><code class="">
    gp2 - General Purpose SSD
    io1 - Provisioned IOPS SSD
    st1 - Throughput Optimized HDD
    sc1 - Cold HDD
    standard - Magnetic volumes
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_volume_type">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_volume_type">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>



## volume_size {#volume_size}

The size of the volume, in gibibytes (GiBs).

| Type | Example Value| Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| string | 50 | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

    

- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_volume_size" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_volume_size" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_volume_size" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_volume_size">
    <pre><code class="">
    Constraints: 1-16384 for gp2, 4-16384 for io1, 500-16384 for st1, 500-16384 for sc1, and 1-1024 for standard (magnetic disk).
        
    Default volume size in GB for each volume types:

    - gp2: 50
    - io1: 50
    - st1: 500
    - sc1: 500
    - standard: 50
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_volume_size">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_volume_size">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>



## keypair {#keypair}

The ssh key pair used to access instances.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| boolean | true, false | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |


- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_keypair" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_keypair" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_keypair" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_keypair">
    Example below is also the default settings when deploying to AWS.
    <pre><code class="language-json">
    "keypair": true
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_keypair">
    Example below is also the default settings when deploying to Alibaba Cloud.
    <pre><code class="language-json">
    "keypair": true
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_keypair">
    Example below is also the default settings when deploying to K5.
    <pre><code class="language-json">
    "keypair": true
    </code></pre>
    </div>
    </div>
    </div>


## subnet {#subnet}

The subnet settings.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | See below | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

A _subnet_ section contains 3 key names.

- `cidr` (string)
  
    The IPv4 CIDR block that you want the subnet to cover (for example, "10.0.0.0/24").

    _Required:_ No
    
    If you don't specify this declarative, the default CIDR block settings will be applied. See below for default values on each cloud platform.

- `public` (boolean)
  
    Defines whether this subnet is public or private. This value is either _true_ or _false_.
    
    If you don't specify this declarative, the default value of _true_ will be applied.
    
    _Required:_ No

- `auto_assign_public_ip` (boolean)
  
    Defines whether automatically assigns a public IP when instance launched into the subnet. This value is either _true_ or _false_.

    _Required:_ No
    
    If you don't specify this declarative, the default value of _true_ will be applied.
    
    If you set `public` as _false_, then this declarative will be ignored.


- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_subnet" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_subnet" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_subnet" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_subnet">
    Example below is also the default settings when deploying to AWS.
    <pre><code class="language-json">
    "subnet": {
        "cidr": "10.0.0.0/24",
        "public": true,
        "auto_assign_public_ip": true
    }
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_subnet">
    Example below is also the default settings when deploying to Alibaba Cloud.
    <pre><code class="language-json">
    "subnet": {
        "cidr": "192.168.199.0/24",
        "public": true,
        "auto_assign_public_ip": true
    }
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_subnet">
    Example below is also the default settings when deploying to K5.
    <pre><code class="language-json">
    "subnet": {
        "cidr": "10.1.0.0/24",
        "public": true,
        "auto_assign_public_ip": true
    }
    </code></pre>
    </div>
    </div>
    </div>




## network_acl {#network_acl}

The network action control list for a virtual private cloud. __This section supports AWS only.__



| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| array | see blow | No | <span class="label label-default">AWS</span> |

A _network acl_ section contains a list of network_acl entry items. Each item contains the following declaratives:

- `rule_number` (int)

    Rule number to assign to the entry, such as 100.
    ACL entries are processed in ascending order by rule number. Entries can't use the same rule number unless one is an egress rule and the other is an ingress rule.
    
    _Required:_ Yes

    For more on valid values, please refer to [this guide](http://docs.aws.amazon.com/AWSEC2/latest/APIReference/API_CreateNetworkAclEntry.html) on aws documentation site.
- `protocol` (string)

    The IP protocol that the rule applies to.
    You must specify -1 or a protocol number. You can specify -1 for all protocols.
    
    _Required:_ Yes

    For more on protocol numbers, please refer to [this guide](http://www.iana.org/assignments/protocol-numbers/protocol-numbers.xhtml).
- `rule_action` (string)

    Whether to allow or deny traffic that matches the rule; valid values are "allow" or "deny".
    
    _Required:_ Yes

- `acl_egress` (boolean)

    Whether this rule applies to egress traffic from the subnet (true) or ingress traffic to the subnet (false).
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _false_ will be applied.

- `cidr_block` (string)

    The IPv4 CIDR range to allow or deny, in CIDR notation (e.g., 172.16.0.0/24).
    
    _Required:_ Yes


For more information about network acl please refer to [AWS Documentation](http://docs.aws.amazon.com/AmazonVPC/latest/UserGuide/VPC_ACLs.html)


- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_network_acl" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_network_acl" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_network_acl" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_network_acl">
    Example below is also the default settings when deploying to AWS.
    <pre><code class="language-json">
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
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_network_acl">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_network_acl">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>



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
    
    _Required:_ Yes
    
    (For more information on cidr calculations, there are tools like [this](http://www.subnet-calculator.com/cidr.php) to helping you get started.)

- `from_port` (int)

    Start of port range for the TCP and UDP protocols, or an ICMP type number. If you specify icmp for the IpProtocol property, you can specify -1 as a wildcard (i.e., any ICMP type number).
    
    _Required:_ Yes

- `ip_protocol` (string)

    IP protocol name or number.
    
    _Required:_ Yes

- `to_port` (int)

    End of port range for the TCP and UDP protocols, or an ICMP code. If you specify icmp for the IpProtocol property, you can specify -1 as a wildcard (i.e., any ICMP code).
    
    _Required:_ Yes



- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_security_group" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_security_group" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_security_group" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_security_group">
    Example below is also the default settings when deploying to AWS.
    <pre><code class="language-json">
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
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_security_group">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_security_group">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>


## auto_scaling {#auto_scaling}

The auto-scaling group defines the configuration to automatically scale up or down the number of compute resources that are being allocated to your application based on its needs at any given time.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | See below | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

The _auto scaling_ section contains the following declarative:


- `min` (int)
    
    The minimum size of the Auto Scaling group.
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _1_ will be applied.
    
- `max` (int)
    
    The maximum size of the Auto Scaling group.
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _1_ will be applied.
    
- `spot_min` (int)
    
    The minimum size of the spot instances in Auto Scaling group.
    
    _Required:_ No
    
    _This declarative supports __AWS__ only, if you specify this value when deploying to other cloud platforms it will be ignored._
    
- `spot_max` (int)
  
    The maximum size of the spot instances in Auto Scaling group.
    
    _Required:_ No
    
    _This declarative supports __AWS__ only, if you specify this value when deploying to other cloud platforms it will be ignored._
  
- `availability_zones` (string)
  
    The list of availability zones for the Auto Scaling group.
    
    _Required:_ Yes
  
- `cooldown` (string)
  
    The number of seconds after a scaling activity is completed before any further scaling activities can start.
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _360_ will be applied.
  
- `healthcheck_grace_period` (string)
  
    The length of time in seconds after a new instance comes into service that Auto Scaling starts checking its health.
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _360_ will be applied.





- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_auto_scaling" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_auto_scaling" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_auto_scaling" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_auto_scaling">
    <pre><code class="language-json">
    "auto_scaling": {
        "min": 1,
        "max": 1,
        "availability_zones": "${use(FlagName1.provision.availability_zone, FlagName2.provision.availability_zone)}",
        "cooldown": "360",
        "healthcheck_grace_period": "360"
    }
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_auto_scaling">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_auto_scaling">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>


## load_balancer {#load_balancer}

The load-balancer for the auto-scaling group.

| Type | Example Value | Required | Supported Platforms |
|:-----------|:-----|:-----|:----------------|
| object | See below | No | <span class="label label-default">AWS</span> <span class="label label-default">AliCloud</span> <span class="label label-default">K5</span> |

The _load balancer_ section contains the following declarative:


- `scheme` (string)
    
    Either _internal_ or _internet-facing_. 
    
    If it's an _internet-facing_ load balancer, a publicly resolvable DNS name will be generated at output section after deployment, whereas a DNS name that resolves to private IP addresses will be generated to _internal_ load balancer. 
    
    _Required:_ No
    
    If you don't specify this declarative, the default value of _internet-facing_ will be applied.
    
- `listeners` (array)
    
    One or more listeners for this load balancer. Each listener must be registered for a specific port, and you cannot have more than one listener for a given port.
    
    _Required:_ Yes. _You must specify at least one entry item for this section._
    
    A _listeners_ section contains a list of entry items with each item contains the following declarative:
    
    - `load_balancer_port` (string)
    
        Specifies the external load balancer port number.
        
        _Required:_ Yes
        
    - `instance_port` (string)
    
        Specifies the TCP port on which the instance server listens.
        
        _Required:_ Yes
        
    - `protocol` (string)
    
        Specifies the load balancer transport protocol to use for routing: _HTTP_, _HTTPS_, _TCP_ or _SSL_.
        
        _Required:_ Yes
        
    - `cert_domain` (string)
    
        __(AWS Only)__
    
        Specifies the domain name to be used for issuing SSL certificate via AWS ACM service.
        
        _Required:_ No
        
        When you provide the domain name here, a verification email will be sent to the domain owner (sent by AWS), and you have to click link found in email to approve the issuance of the SSL certificate before the stack provision can be finished.
        
        Once the provision deployment is successfully done, the SSL certificate will be attached to your load-balancer automatically.
        
- `health_check` (object)
    
    __(AWS Only)__
    
    Application health check for the instances.
    
    _Required:_ No
    
    A _health check_ section contains the following declarative:
    
    - `healthy_threshold` (string)
    
        Specifies the number of consecutive health probe successes required before moving the instance to the Healthy state.
        
        _Required:_ Yes
    
    - `interval` (string)
    
        Specifies the approximate interval, in seconds, between health checks of an individual instance. Valid values are 5 to 300.
        
        _Required:_ Yes
    
    - `target` (string)
    
        Specifies the instance's protocol and port to check. The protocol can be TCP, HTTP, HTTPS, or SSL. The range of valid ports is 1 through 65535.
        
        _Required:_ Yes
    
    - `timeout` (string)
    
        Specifies the amount of time, in seconds, during which no response means a failed health probe. This value must be less than the value for _interval_.
        
        _Required:_ No
    
    - `unhealthy_threshold` (string)
    
        Specifies the number of consecutive health probe failures required before moving the instance to the Unhealthy state.
        
        _Required:_ No




- ### Valid Values


    <div class="tabs tabs-text">
    <ul class="nav nav-tabs text-right" role="tablist">
    <li role="presentation" class="active">
    <a href="#aws_load_balancer" aria-controls="home" role="tab" data-toggle="tab">AWS</a>
    </li>
    <li role="presentation">
    <a href="#alicloud_load_balancer" aria-controls="profile" role="tab" data-toggle="tab">Alibaba Cloud</a>
    </li>
    <li role="presentation">
    <a href="#k5_load_balancer" aria-controls="messages" role="tab" data-toggle="tab">K5</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active fade in" id="aws_load_balancer">
    <pre><code class="language-json">
    "load_balancer": {
        "scheme": "internet-facing",
        "listeners": [
            {
                "load_balancer_port": "443",
                "instance_port": "80",
                "protocol": "HTTPS",
                "cert_domain": "*.mobingi.com"
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
    </code></pre>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="alicloud_load_balancer">
    This section hasn't been covered by documentation.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="k5_load_balancer">
    This section hasn't been covered by documentation.
    </div>
    </div>
    </div>
