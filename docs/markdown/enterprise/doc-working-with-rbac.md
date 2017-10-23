
### Permission Priority {#permission-priority}

When a request is made, the RBAC service decides whether a given request should be allowed or denied. The evaluation logic follows these rules:

 - By default, all requests are denied (_Note: when you creating a user on Mobingi ALM, a [default role](https://learn.mobingi.com/alm-rbac-reference#default-roles) is applied automatically and allows certain scopes by default_ )
 - An explicit allow overrides this default
 - Deny pattern always overrides allow pattern against same resources
 - An explicit deny overrides any allows

 The order in which the policies are evaluated has no effect on the outcome of the evaluation. All policies are evaluated, and the result is always that the request is either allowed or denied. Below is an example to result in a __deny__ on action `template:updateAlmTemplate` over any resources:

    ```json
    {
        "Statement": [
            {
                "Effect": "Deny",
                "Action": "template:updateAlmTemplate",
                "Resource": [
                    "*"
                ]
            },
            {
                "Effect": "Deny",
                "Action": "template:updateAlmTemplate",
                "Resource": [
                    "mrn:alm:template:mo-AAAAAAAAAAA"
                ]
            },
            {
                "Effect": "Allow",
                "Action": "template:updateAlmTemplate",
                "Resource": [
                    "mrn:alm:template:mo-BBBBBBBBBB"
                ]
            }
        ]
    }
    ```

 - If there is no _deny_ pattern but has _allow_ pattern defined, the request is allowed on defined resources only

 The example below allows the action of `template:updateAlmTemplate` over resource _mrn:alm:template:mo-5447820c870e1-ZgNTSRM8K-tk_ only.

    ```json
    {
     "Statement": [
         {
             "Effect": "Allow",
             "Action": "template:updateAlmTemplate",
             "Resource": [
                 "mrn:alm:template:mo-5447820c870e1-ZgNTSRM8K-tk"
             ]
         }
     ]
    }
    ```

### Apply Order {#apply-order}

 - Allow pattern always applies first
 - Deny pattern overrides allows
 - Additionally, when response body contains resources that denies by the role, RBAC will filter that resource and return the rest of its body.

### Resource Dependency {#resource-dependency}

When you working with Mobingi ALM, there are a few resource depends on parent resource, eg:

 - stack depends on credentials and vendor
 - instance logs depends on stack or its parent

 _An example dependency:_

    ```
    vendor > credentials > stack > log > others
    ```

- Sample: filter resource permissions by `credentials` role. Since stacks resource depends on credentials, the example below defines:

 - Deny when a user trying to describe stacks associated to credential _AAAAA_, or _BBBBB_
 - Allow when a user trying to describe stacks associated to any other credentials

    ```json
    {
        "Statement": [
            {
                "Effect": "Deny",
                "Action": "cred:describeCredentials",
                "Resource": [
                    "mrn:vendor:aws:cred:AAAAA",
                    "mrn:vendor:aws:cred:BBBBB",
                ]
            },
            {
                "Effect": "Allow",
                "Action": "cred:describeCredentials",
                "Resource": [
                    "*"
                ]
            }
        ]
    }
    ```


## Condition Rules {#condition-rules}

A part of actions supported Condition rules.

```
stack:describaStacks
stack:describeStack
template:updateAlmTemplate
stack:deleteStack
```

Below actions limit own data by default rules.
```
stack:describeStack
template:updateAlmTemplate
stack:deleteStack
```

These action has default Condition and limit by condition rules.
 - ```_SUBUSER_``` is defined by system for owner user.
 - Condition rules of Allow effect is highest priority than normal.

```json
{
 "Statement": [
     {
         "Effect": "Allow",
         "Action": "*",
         "Resource": [
             "*"
         ]
     },
     {
         "Effect": "Allow",
         "Action": [
             "stack:describeStack",
             "template:updateAlmTemplate",
             "stack:deleteStack"
         ],
         "Resource": [
             "*"
         ],
         "Condition": {
             "ownerFilter": {
                      "username":["_SUBUSER_"]
                    }                
            }
     }
 ]
}
```

- Condition rules of Deny effect is lower than normal.
- Below Condition for ```stack:describeStacks```  does not work. before apply condition rules, deny action works.

```json
{
 "Statement": [
     {
         "Effect": "Deny",
         "Action": "stack:describeStacks",
         "Resource": [
             "*"
         ]
     },
     {
         "Effect": "Deny",
         "Action": [
             "stack:describeStacks"
         ],
         "Resource": [
             "*"
         ],
         "Condition": {
             "ownerFilter": {
                      "username":["testuser"]
                    }                
            }
     }
 ]
}
```
