

### Deny Vendors {#deny-vendors}

- ATTENTION: deny describeVendors depends other actions

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : "vendor:describeVendors",
          "Resource" : ["mrn:vendor:alicloud"]
      }

    ]
}
```


### Deny Credentials by resource {#deny-credentials-resource}

 - ATTENTION: deny describeCredentials depends other actions

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : "cred:describeCredentials::aws",
          "Resource" : ["mrn:vendor:aws:cred:XXXXXXXXXXXXXX"]

      }

    ]
}
```


### Deny List Stack {#deny-list-stack}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : "stack:describeStacks",
          "Resource" : ["*"]

      }

    ]
}
```

### Deny List Stack with filtering resource {#deny-list-stack-resource}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : "stack:describeStacks",
          "Resource" : ["mrn:alm:stack:mo-XXXXXXXXXXXXXXXXX"]

      }

    ]
}
```

### Deny Get Stack detail by resource {#deny-stack-resource}

```json
{
  "Version": "2017-05-05",
  "Statement": [
      {
          "Effect" : "Deny",
          "Action" : "stack:describeStack",
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
          "Resource" : ["mrn:alm:stack:mo-XXXXXXXXXXXXXX","mrn:alm:template:mo-XXXXXXXXXXXXXX"]

      }

    ]
}
```
