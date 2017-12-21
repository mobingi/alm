Mobingi ALM provides several built-in functions that help you manage your Alm-template. These functions are named __ATL__, short for ___A__lm __T__emplate __L__anguage._

Use ATL functions in your templates to assign values to properties that are not available until runtime.

__Note:__

    You can use ATL functions only in specific parts of a template. Please refer to each functions' document for detailed explanation.

## computed {#computed}

Usage:

`${computed}`

## use {#use}

Usage:

`${use( .. )}`

## copy {#copy}

Usage:

`${copy( .. )}`

## ref {#ref}

Usage:

`#ref( .. )`

Currently, this function can be used only in:

1. load_balancer : security_groups

```json
"load_balancer": {
    "security_groups": "#ref(Layer2.provision.security_group)",
},
```

Use case explanation:

When the load balancer requires a specified security groups other than the security group defined for instance, you can use this function to reference the security groups that defined in other layers.

## share {#share}

Usage: `#share( .. )`


Currently, this function can be used in two declarative:

1. load_balancer : subnets

```json
"load_balancer": {
    "subnets": "#share(Layer1.provision.subnet,Layer2.provision.subnet)",
},
```

Use case explanation:

When deploying an _application_ or _networking_ load balancer on AWS, each load balancer requires at least two subnets, so you use this function to reference which subnet for this load balancer to share with.

2. auto_scaling

```json
{
    "auto_scaling": "#share(Layer1.provision.auto_scaling)"
}
```

Use case explanation:

When deploying multiple load balancers for the instances in the same auto scaling group (especially for application load balancer case on AWS), you use this function to reference which auto scaling group to share this load balancer with.

