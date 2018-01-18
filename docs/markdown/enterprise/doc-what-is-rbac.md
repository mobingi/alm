RBAC is a policy document that formally states one or more permissions. To assign permissions to a user, you create a policy, which is a document that explicitly lists permissions.

## RBAC Concepts {#concepts}

### Create Roles

 - Create roles can be done by root account only. _(Root account is the one you login using your email address.)_
 - Create roles action can be performed through CLI, API or UI.
 - Editing roles is simple and straightforward. All users under your root account will be able to view their roles that assigned to them.

### Attach Roles to User or Teams

 - Role can be created by root account only
 - Role can be assigned to _Users_ and _Teams_
 - _Users_ or _Teams_ can be attached with one Role only
 - Roles assigned on _Team_ will overwrite the roles assigned on _User_

### End User Effect

 - When users login to Mobingi ALM dashboard (or interacting through CLI or API), roles that attached to them will be evaluated on every action request.
 - If an action isn't granted by the role definition, such action will be denied.
 - If an action is grated by the role definition, the action will be allowed.


## How Does RBAC Work? {#how-does-it-work}

Before any requests goes in, the RBAC module will check for the current user's role settings first, then it passes or denies the request.

![Image of RBAC Concept](https://learn-cdn.mobingi.com/images/rbac-concept.png)


For the requests being passed, there is no other actions need to perform. 

For the requests been denied, the client (usually UI console, or API and CLI) will returned with the following error:

```json
HTTP Status Code 403
{
    "RBAC": "Action not allowed"
}
```

### A Working Example

Apply the following example to your ALM user to allow performing every action excepts _deleting stacks_:

```json
{
    "version": "2017-05-05",
    "statement": [
        {
            "effect": "allow",
            "action": "*",
            "resource": "*"
        },
        {
            "effect": "deny",
            "action": "delete:alm.stack",
            "resource": "*"
        }
    ]
}
```


For more examples, please refer to [Example RBAC Roles](https://learn.mobingi.com/enterprise/rbac-example-roles).