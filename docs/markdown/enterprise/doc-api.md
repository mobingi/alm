### API Endpoint {#end-point}

- Mobingi hosted version

<div class="callout callout-info">
  <p>https://api.mobingi.com</p>
</div>

- Self-hosted version

<div class="callout callout-info">
  <p>https:// {INSTALLATION_PATH}</p>
</div>

### Versioning {#versioning}

The current supported API version is `v3`.

### OAuth Authentication {#authentication}

In order to interact with the API, your application must authenticate. Mobingi API handles this through __OAuth__. An OAuth token functions as a complete authentication request. In effect, it acts as a substitute for a username and password pair.

_To get an OAuth token, make a POST request to_

<div class="callout callout-info">
POST <code>/v3/access_token</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| client_id       | string        | Yes       |             |
| client_secret       | string        | Yes       |              |
| grant_type       | string        | Yes       | This value is always `client_credentials`             |


Example Request:

```bash
curl -X POST https://api.mobingi.com/v3/access_token \
-H "Content-Type: application/json" \
-d '{"grant_type":"client_credentials","client_id":"lg-5447826c870e7-xBV0OSJEN-tm","client_secret":"sFVYDoe08fxPjNgYvauYGOYCeXbOTE","grant_type":"client_credentials"}'
```

Response Body:

```json
{
  "token_type": "Bearer",
  "expires_in": 43200,
  "access_token": "eyJ0eXAiOiJQiLCJhbGciOMeXzQfME"
}
```
You can then start making API requests by passing the `access_token` value to the _Authorization_ Header

```
Authorization: Bearer eyJ0eXAiOiJQiLCJhbGciOMeXzQfME
```


## ALM Templates {#alm-templates}

xxxxxxxxxxxxx.

### Create Template {#templates-create}

<div class="callout callout-info">
POST <code>/v3/alm/template</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| php:input       | string        | Yes       | Json strings            |


Example Request:

```bash
curl -X POST https://api.mobingi.com/v3/alm/template \
-H "Content-Type: application/json, Authorization:Bearer xxxxxxxxxxxxx \
-d '{"template":"{xxxx:xxxxx,label:123,description:123}"}'

```
Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```
Request Body:

```json
"{alm-template json string}"
```

Response Body:

```json
{
    "success" : "true",
    "template_id" : "xxxxxxxx",
    "version_id" : "xxxxxxxx"
}
```

### Update Template {#templates-update}

<div class="callout callout-info">
PUT <code>/v3/alm/template/{template_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| version_id       | string        |        | Copy from other version            |
| template       | string        |        | Json strings for update alm-template           |
| label       | string        |        | Use coping from other version, if change.            |
| description       | string        |        | Use coping from other version, if change.            |


Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```
Request Body:

update template
```json
template: "{alm-template json string}"
```

copy template from other version
```json
version_id: "sFVYDoe0************TE.dSIGdk="
label: "new label"
description: "new description"
```


Response Body:

```json
{
    "success" : "true",
    "template_id" : "xxxxxxxx",
    "version_id" : "xxxxxxxx"
}
```

### Describe Template {#templates-describe}

<div class="callout callout-info">
GET <code>/v3/alm/template/{template_id}?version_id=XXXXXX</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| version_id       | string        |        | if need old version.            |



Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```


Response Body:

```json
{
    "auth_token": "xxxxxxxxxx",
    "nickname": "xxxxxxxxxx",
    "stack_id": "XXXXXXXXXXXXX",
    "stack_status": "CREATE_IN_PROGRESS",
    "version_id": "XXXXXXXXXXXXXXXXXXX",
    "vendor": {
        "aws": {
          "cred": "AKIAJ2*********2DZLA"
        }            
    },
    "user_id": "XXXXXXXX",
    "username": "UUUUUUUU",    
    "configuration": {
        "version": "2017-05-05",
        "label": "new label",
        "description": "new description",
        "vendor": {
            "aws": {
              "cred": "AKIAJ2*********2DZLA"
            }            
        },
        "configurations": [
        ....

        ]
    },
    "create_time": "2017-08-23T09:10:13+09:00",
    "update_time": "2017-08-23T09:34:15+09:00",
    "versions": [
        {
            "VersionId": "XXXXXXXXXXXXXXXXXXX",
            "latest": true,
            ....
        },
        {
            "VersionId": "YYYYYYYYYYYYYYYYY",
            "latest": false,
            ....            
        }
    ]
}
```


### List Template {#templates-list}

<div class="callout callout-info">
GET <code>/v3/alm/template</code>
</div>



Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```


Response Body:

```json
[
    {
        "auth_token": "xxxxxxxxxx",
        "nickname": "xxxxxxxxxx",
        "stack_id": "XXXXXXXXXXXXX",
        "stack_status": "CREATE_IN_PROGRESS",
        "version_id": "XXXXXXXXXXXXXXXXXXX",
        "vendor": {
            "aws": {
              "cred": "AKIAJ2*********2DZLA"
            }            
        },
        "user_id": "XXXXXXXX",
        "username": "UUUUUUUU",    
        "configuration": {
            "version": "2017-05-05",
            "label": "new label",
            "description": "new description",
            "vendor": {
                "aws": {
                  "cred": "AKIAJ2*********2DZLA"
                }            
            },
            "configurations": [
            ....

            ]
        },
        "create_time": "2017-08-23T09:10:13+09:00",
        "update_time": "2017-08-23T09:34:15+09:00"
    },
    {
        ...
    }
]

```


### Compare Template {#templates-compare}

<div class="callout callout-info">
POST <code>/v3/alm/template/compare</code>
</div>

| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| id       | array        |        | array  2value only            |
| body       | array        |        | array 2value only            |

 - first priority is id.

Compare(source, target)
 | Parameters    |  Detail       |
 | ------------- | :------------|
 | source (edited)        | id[0] if no id, use body[0]   |
 | target (original)        | id[1] if no id, use body[1] or body[0] |

Compare Result
| Parameters    |  Detail       |
| ------------- | :------------|
| new        | new values   |
| removed        | deleted values |
| edited        | changed values. output old value,new value  |




Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```

Request Body:


```json
id:[
    {"mo-578e0********9-7********RY-tk":
        {"version":"EhF********eFpW2"}
    },
    {"mo-578e0********9-7********RY-tk":
        {"version":"Xmxk*********Mu._MXVO4lGZuoXk"}
    }
]
```

Response Body:


```
{
    "status": "success",
    "source": {
        "hoge": "hoge",
        "fufdfdfdga": "fhhhuga",
        "label": "xx222222211originalxccccccccddddabel test",
        "description": "desc tefdfdfdffffst"
    },
    "target": {
        "hoge": "hoge",
        "fufdfdfdga": "fhhhuga",
        "label": "xx11111111originalxccccccccddddabel test",
        "description": "desc tefdfdfdffffst"
    },
    "diff": {
        "new": [],
        "removed": [],
        "edited": {
            "label": {
                "oldvalue": "xx11111111originalxccccccccddddabel test",
                "newvalue": "xx222222211originalxccccccccddddabel test"
            }
        }
    }
}
```

Sample2:

```json
id:[
    {"mo-5*******c9-7W*****RY-tk":
        {"version":"EhFEL**********UxjyYZxeFpW2"}
    }
]
body:[
    {"test":"1111"},
    {"test":"333"}
]
```
Response Body:

```json
{
    "status": "success",
    "source": {
        "hoge": "hoge",
        "fufdfdfdga": "fhhhuga",
        "label": "xx222222211originalxccccccccddddabel test",
        "description": "desc tefdfdfdffffst"
    },
    "target": {
        "test": "333"
    },
    "diff": {
        "new": {
            "hoge": "hoge",
            "fufdfdfdga": "fhhhuga",
            "label": "xx222222211originalxccccccccddddabel test",
            "description": "desc tefdfdfdffffst"
        },
        "removed": {
            "test": "333"
        },
        "edited": []
    }
}
```
