RBAC is a policy document that formally states one or more permissions. To assign permissions to a user, you create a policy, which is a document that explicitly lists permissions.

## RBAC Concepts {#concepts}


## How does RBAC Work? {#how-does-it-work}

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