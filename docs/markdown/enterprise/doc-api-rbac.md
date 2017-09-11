## ALM RBAC {#alm-rbac}



### Create Role {#rbac-create-role}

Create Mobingi Role define.
This endpoint allow master user only.

<div class="callout callout-info">
POST <code>/v3/role</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|   name  | string        | Yes       | Name of Mobingi Role            |
|   scope  | string        | Yes       | Mobingi Role in json string format            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/x-www-form-urlencoded
```

Request body
```bash
{
  "name": "sample name",
  "scope": { _role define body_ }
}
```

Response Body

```bash
HTTP/1.1 200

{
  "status": "success",
  "role_id": "morole-544****0e1-ZgNTSRM8K-tk"
}
```

### Update Role {#rbac-update-role}

Update Mobingi Role define.
This endpoint allow master user only.

<div class="callout callout-info">
PUT <code>/v3/role/{role_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|   name  | string        | Yes       | Name of Mobingi Role            |
|   scope  | string        | Yes       | Mobingi Role in json string format            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/x-www-form-urlencoded
```

Request body
```bash
{
  "name": "sample name",
  "scope": { _role define body_ }
}
```

Response Body

```bash
HTTP/1.1 200

{
  "status": "success",
  "role_id": "morole-544****70e1-ZgNTSRM8K-tk"
}
```

### Delete Role {#rbac-delete-role}


Delete Mobingi Role define.
This endpoint allow master user only.

<div class="callout callout-info">
DELETE <code>/v3/role/{role_id}</code>
</div>

Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200

{
  "status": "success",
  "role_id": "morole-544****0e1-ZgN****M8K-tk"
}
```

### Describe Roles {#rbac-list-role}

list Mobingi Role define.

<div class="callout callout-info">
GET <code>/v3/role</code>
</div>


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200
[
    {
        "role_id": morole-544****0e1-ZgNT***M8K-tk,
        "user_id": 544****0e1,
        "name": sample name,
        "scope": { _role define body_ },
        "create_time": ,
        "update_time":
    },
    {
        ....
    }

]
```


### Describe UserRole By username {#rbac-describe-userrole-by-username}


list user's Mobingi Role define.
This endpoint allow master user only.

<div class="callout callout-info">
GET <code>/v3/user/{username}/role</code>
</div>


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200
[
    {
        role_id: morole-544****0e1-ZgNT***M8K-tk,
        user_id: 544****0e1,
        name: sample name,
        scope: { _role define body_ },
        create_time: ,
        update_time:
    },
    {
        ....
    }

]
```

### Create UserRole {#rbac-create-userrole}


attach Mobingi Role to subuser.
This endpoint allow master user only.

<div class="callout callout-info">
POST <code>/v3/user/role</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|   username  | string        | Yes       | target subuser            |
|   role_id  | string        | Yes       | Mobingi Role Id            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/x-www-form-urlencoded
```

Request body
```bash
{
  "username": "testtest",
  "role_id": "morole-544****0e1-ZgN****8K-tk"
}
```

Response Body

```bash
HTTP/1.1 200
{
  "status": "success",
  "user_role_id": "mour-544****0e1-ZgN****M8K-tk"
}
```

### Update UserRole {#rbac-update-userrole}

re-attach Mobingi Role to subuser.
This endpoint allow master user only.

<div class="callout callout-info">
PUT <code>/v3/user/role/{role_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|   username  | string        | Yes       | target subuser            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/x-www-form-urlencoded
```

Request body
```bash
{
  "username": "testtest"
}
```

Response Body

```bash
HTTP/1.1 200

{
  "status": "success",
  "role_id": "morole-5447****0e1-ZgN***M8K-tk"
}
```


### Delete UserRole {#rbac-delete-userrole}

delete Mobingi Role from subuser.
This endpoint allow master user only.

<div class="callout callout-info">
DELETE <code>/v3/user/role/{role_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|   username  | string        | Yes       | target subuser            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Request body
```bash
{
  "username": "testtest"
}
```

Response Body

```bash
HTTP/1.1 200

{
  "status": "success",
  "role_id": "morole-5447****0e1-ZgN****M8K-tk"
}
```

### Describe UserRole {#describe-userrole}


list current user's Mobingi Role define.

<div class="callout callout-info">
GET <code>/v3/user/role</code>
</div>


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200
[
    {
        "user_role_id": "mour-5447****0e1-TEW****dsIE-tk",
        "role_id": "morole-5447****0e1-ZgN****RM8K-tk",
        "user": { user_id: 5447****0e1, username: tes***est },
        "scope": { _role define body_ },
        "create_time": ,
        "update_time":
    },
    {
        ....
    }

]
```

### Describe Role Template {#rbac-describe-role-template}

list role template.

<div class="callout callout-info">
GET <code>/v3/role/templates</code>
</div>


Request Header
```bash
Content-Type: application/json
```


Response Body

```bash
HTTP/1.1 200
[
    {
        "id": "admin",
        "name": "管理者権限",
        "scope": {
            "version": "2017-05-05",
            "Statement": [
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
    },
    {
        ....
    }
]
```


### Mobingi Role define Body {#rbac-role-format}

- This is role define format sample.
- About Action or Resource strings, Reference RBAC user's guide.

```bash
"Version": "2017-05-05",
"Statement": [
    {
        "Effect": "Deny",
        "Action": [
            "stack:describeStacks"
        ],
        "Resource": [
            "mrn:alm:stack:mo-xxxxxxxxxx"
        ]
    }
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

```

### Filter or Reject Response {#rbac-error-response}

- RBAC rejects endpoint access with error code.

Response Body

```bash
HTTP/1.1 403

{
    code: 4000
    message: RBAC response is limited.
    description: {$message}
}
```

- RBAC's some endpoint return filtered response.
- Each endpoint has filter key.

Response Body

```bash
HTTP/1.1 200

[
    {
        stack_id : ......
    }
    {
        .....
    }

]
```
