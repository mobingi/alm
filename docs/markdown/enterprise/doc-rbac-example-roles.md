

### Allow All {#allow-all}


```json
{
    "version": "2017-05-05",
    "statement": [
        {
            "effect": "allow",
            "action": "*",
            "resource": "*"
        }
    ]
}
```

### Allow UI Login {#allow-login}


```json
{
    "version": "2017-05-05",
    "statement": [
        {
            "effect": "allow",
            "action": "view:user.login",
            "resource": "*"
        }
    ]
}
```

### Deny Credentials {#deny-credentials}


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
            "action": "*:credentials",
            "resource": ["AKIAJ7Z8PGXEZTIJOL6IQ"]
        }
    ]
}
```


### Deny List Stacks {#deny-list-stack}


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
            "action": "view:alm.stack",
            "resource": "*"
        }
    ]
}
```


### Deny List Stacks by Resource {#deny-list-stack-resource}


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
            "action": "view:alm.stack",
            "resource": ["mo-590fdb7bad55s-tJZpgRCBs-tk", "mo-590fdb7bad55s-ugMgQQ1TE-tk"]
        }
    ]
}
```



### Deny Deleting Stacks by Resource {#deny-delete-stack-resource}


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
            "resource": ["mo-590fdb7bad55s-tJZpgRCBs-tk"]
        }
    ]
}
```



