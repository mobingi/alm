

### Deny Vendors {#deny-vendors}

- ATTENTION: _describeVendors_ action has child action dependencies

```json
{
    "Version": "2017-05-05",
    "Statement": [
        {
            "Effect" : "Deny",
            "Action" : ["vendor:describeVendors"],
            "Resource" : ["mrn:vendor:alicloud"]
        }
    ]
}
```


### Deny Credentials by Resource {#deny-credentials-resource}

 - ATTENTION: _describeCredentials_ action has child action dependencies

```json
{
    "Version": "2017-05-05",
    "Statement": [
        {
            "Effect" : "Deny",
            "Action" : ["cred:describeCredentials::aws"],
            "Resource" : ["mrn:vendor:aws:cred:XXXXXXXXXXXXXX"]
        }
    ]
}
```


### Deny List Stacks {#deny-list-stack}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : ["stack:describeStacks"],
          "Resource" : ["*"]

      }

    ]
}
```

### Deny List Stacks with Resource Filtering {#deny-list-stack-resource}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : ["stack:describeStacks"],
          "Resource" : ["mrn:alm:stack:mo-XXXXXXXXXXXXXXXXX"]
      }
    ]
}
```

### Deny Describe Stack by Resource {#deny-stack-resource}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : ["stack:describeStack"],
          "Resource" : ["mrn:alm:stack:mo-XXXXXXXXXXXXXX"]
      }
    ]
}
```

### Deny Some Actions {#deny-some-actions}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : [
              "stack:describeStacks",
              "template:updateAlmTemplate",
              "stack:deleteStack"
          ],
          "Resource" : [
              "mrn:alm:stack:mo-XXXXXXXXXXXXXX",
              "mrn:alm:template:mo-XXXXXXXXXXXXXX"
          ]
      }
    ]
}
```

### Deny console Login {#deny-consolelogin-actions}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : [
              "user:consoleLoginUser"
          ],
          "Resource" : [
              "*"
          ]
      }
    ]
}
```

### Limit listStack by allow condition {#limit-liststack-actions}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Allow",
          "Action" : [
              "stack:describeStacks"
          ],
          "Resource" : [
              "*"
          ],
          "Condition" : {
              "ownerFilter": {
                  "username": [ "_SUBUSER_", "user1", "user2" ]
              }
          }
      }
    ]
}
```
