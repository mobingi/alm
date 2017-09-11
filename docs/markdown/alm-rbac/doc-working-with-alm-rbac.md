
## 2. Usage

### Permission priority

 - Deny pattern is first. and deny pattern can not be overwritten.
 - This case apply deny all.
```
{
    Statement: [
        {
            Effect: "Deny",
            Action: "template:updateAlmTemplate",
            Resource: [
                "*"
            ]
        },
        {
            Effect: "Deny",
            Action: "template:updateAlmTemplate",
            Resource: [
                "mrn:alm:template:mo-AAAAAAAAAAA"
            ]
        },
        {
            Effect: "Allow",
            Action: "template:updateAlmTemplate",
            Resource: [
                "mrn:alm:template:mo-BBBBBBBBBB"
            ]
        }
    ]
}
```

 - no deny pattern is not allow all.
 - This case apply allow updateStack only.
 ```
 {
     Statement: [
         {
             Effect: "Allow",
             Action: "template:updateAlmTemplate",
             Resource: [
                 "mrn:alm:template:mo-xxxxxxxxxxxxxxx"
             ]
         }
     ]
 }
 ```

### Apply order

 - firstly, deny pattern apply.
 - allow pattern is checked after not match deny.
 - exceptionally, response many data, then RBAC filter data by deny rules.

### Depends resource

 - a few resource depends on parent Resource.
 - stack depend credentials and vendor.
 - stack log depend stack or that parent.
```
 ex.) vendor > credentials > stack > log > others
```

### ex.1 Filter stack list with credentials

 - For example, subUser limit stacklist with credential.
 - This case, add deny pattern below.

 ```
 {
     Statement: [
         {
             Effect: "Deny",
             Action: "cred:describeCredentials",
             Resource: [
                 "mrn:vendor:aws:cred:XXXXXXXXXXXXXX",
                 "mrn:vendor:aws:cred:XXXXbbbbbbbbbb",
             ]
         },
         {
             Effect: "Allow",
             Action: "cred:describeCredentials",
             Resource: [
                "*"
             ]
         },
     ]
 }
 ```
