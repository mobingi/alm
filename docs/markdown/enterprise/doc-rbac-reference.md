Mobingi ALM RBAC role body is a json format string contains several sections.
This page explains the reference on each section. 
For quick referencing with example roles please refer to [this](https://learn.mobingi.com/alm-rbac-example-rbac) guide.

## Version {#version}

Current RBAC version is `2017-05-05`

## Statement {#statement}

Statement is the section contains the role policy body

## Effect {#effect}

This section defines what the effect will be when the user requests access. This value is either __allow__ or __deny__.

## Action {#action}

This section defines what actions you will grant. Each Mobingi ALM service has its own set of actions. For example, you might allow a user to list all stacks or deny a user to perform delete stack.

 - RBAC Actions List:

    |Service|Actions|
    |:--|:--|
    |Credential|view:credentials|
    | |create:credentials|
    | |delete:credentials|
    |Template|view:alm.template|
    | |create:alm.template|
    | |edit:alm.template|
    |Stack|view:alm.stack|
    | |create:alm.stack|
    | |edit:alm.stack|
    | |delete:alm.stack|
    |Registry|view:alm.registry|
    | |create:alm.registry|
    | |edit:alm.registry|
    | |delete:alm.registry|
    |Login|view:user.login|

## Resource {#resource}

Which resources you allow the action on. For example, what specific stack will you allow the user to perform the _describeStack_ action on.

 - when `*` is given, all resources are applied
 - when explicit value is given, only that resource is applied

### Example Resource Values


 - Allow read only permissions on two specific stacks:
 
 ```json
 {
     "version": "2017-05-05",
     "statement": [
         {
             "effect": "allow",
             "action": "view:alm.stack",
             "resource": ["mo-590fdb7bad55s-tJZpgRCBs-tk", "mo-590fdb7bad55s-ugMgQQ1TE-tk"]
         }
     ]
 }
 ```
 - Deny users from using specific cloud account credential:
 
 ```json
 {
     "version": "2017-05-05",
     "statement": [
         {
             "effect": "deny",
             "action": "*",
             "resource": ["AKIAJ7Z8PGXEZTIJOL6IQ"]
         }
     ]
 }
 ```
 Explanation: 
 
 _Suppose "AKIAJ7Z8PGXEZTIJOL6IQ" is the credential resource of an AWS account that you saved at ALM, the above policy will deny user from performing any actions against that AWS account._ 



## Default Roles {#default-roles}

When a user is first created by root account, this user has no privileges to perform any API actions. You need to first grant a role to the user.



