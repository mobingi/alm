Mobingi ALM RBAC role body is a json format body contains several sections. This page explains the reference on each section. For quick referencing with example roles please refer to [this](https://learn.mobingi.com/alm-rbac-example-rbac) guide.

## Version {#version}

Current RBAC version is `2017-05-05`

## Statement {#statement}

Statement is the section contains the role policy body

## Effect {#effect}

This section defines what the effect will be when the user requests access. This value is either __allow__ or __deny__.

## Action {#action}

This section defines what actions you will grant. Each Mobingi ALM service has its own set of actions. For example, you might allow a user to list all stacks or deny a user to perform delete stack.

 - RBAC actions:

    |Service|Action|Example|
    |:--|:--|:--|:--|:--|
    |vendor|describeVendors|vendor:describeVendors|
    |cred|describeCredentials::aws|vendor:aws:cred:describeCredentials::aws|
    |-|describeCredentials::alicloud|vendor:alicloud:cred:describeCredentials::alicloud|
    |-|createCredential::{vendor}|cred:createCredential::aws|
    |-|deleteCredential::{vendor}|cred:deleteCredential::aws|
    |stack|describeStacks|stack:describeStacks|
    |-|deleteStack|stack:deleteStack|
    |template|createAlmTemplate|template:createAlmTemplate|
    |-|updateAlmTemplate|template:updateAlmTemplate|

## Resource {#resource}

Which resources you allow the action on. For example, what specific stack will you allow the user to perform the _describeStack_ action on.

 - when `*` is given, all resources are applied
 - when explicit value is given, only that resource is applied

### Example Mobingi Resource Names (MRN)

- ### Vendor
 - mrn:vendor:aws
 - mrn:vendor:alicloud
 - mrn:vendor:k5

- ### Credentials

 - mrn:vendor:aws:cred:AAAAAAAAAAAAAAAA
 - mrn:vendor:alicloud:cred:*

- ### Stack

 - mrn:alm:stack:*
 - mrn:alm:stack:mo-xxxxxxxxxxxxxxxx

- ### Template

  - mrn:alm:template:*
  - mrn:alm:template:mo-xxxxxxxxxxxxxxxx





## Default Roles {#default-roles}

When your master account is first set up, a default admin role is automatically assigned to your master account. Similarly, when you create a user on Mobingi ALM, a default role is applied automatically to that user and allows certain scopes by default. Below are the default roles:


 - ### Master Account

    ```json
    {
        "version": "2017-05-05",
        "Statement":[
            {
                "Effect": "Deny",
                "Action": [
                    "template:createAlmTemplate"
                ],
                "Resource": [
                    "*"
                ]
            },
            {
                "Effect": "Allow",
                "Action": [
                    "*"
                ],
                "Resource": [
                    "*"
                ]
            },
        ]
    }
    ```

 - ### User

    ```json
    {
        "version": "2017-05-05"
        "Statement":[
            {
                "Effect": "Deny",
                "Action": [
                    "role:describeRoles"
                    "role:createRole",
                    "role:updateRole",
                    "role:deleteRole",
                    "user:describeMobingiUsers",
                    "user:createMobingiUser",
                    "user:deleteMobingiUser",
                    "userrole:describeUserRoleByUserName",
                    "userrole:createUserRole",
                    "userrole:updateUserRole",
                    "userrole:deleteUserRole"
                ],
                "Resource": [
                    "*"
                ]
            },
            {
                "Effect": "Deny",
                "Action": [
                    "cred:createCredentials::aws",
                    "cred:deleteCredentials::aws",
                    "cred:createCredentials::alicloud",
                    "cred:deleteCredentials::alicloud",
                    "cred:createCredentials::k5",
                    "cred:deleteCredentials::k5"
                ],
                "Resource": [
                    "*"
                ]
            },
            {
                "Effect": "Allow",
                "Action": [
                    "*"
                ],
                "Resource": [
                    "*"
                ]
            }
        ]
    }
    ```
