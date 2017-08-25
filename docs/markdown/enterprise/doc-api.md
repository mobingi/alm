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


### Apply Template {#template-apply}

Applies the _Mobingi Alm_ template and creates the stack resources if template format is valid.

<div class="callout callout-info">
POST <code>/v3/alm/template</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
|  { _template body_ }  | string        | Yes       |  Mobingi Alm template body in json string format            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Request body
```bash
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "AKIAJ...DZLA",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Web01",
      "provision": {
        "image": "${computed}",
        "volume_type": "${computed}",
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": true
      }
    }
  ]
}
```

Response Body

```bash
HTTP/1.1 201 Created

{
  "status": "success",
  "stack_status": "CREATE_IN_PROGRESS",
  "template_id": "mo-5447820c870e1-ZgNTSRM8K-tk",
  "version_id": "98O0jK6CQk8qLi14S2SLU8z3JIo3.JPx"
}
```



### Update Template {#template-update}

Updates the _Mobingi Alm_ template and applies the changes to stack resources.

_Note:_ `vendor` section will be ignored when performing this API call. You can not change cloud vendors after the stack is created.

<div class="callout callout-info">
PUT <code>/v3/alm/template/{template_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| { _template body_ } | string        |        | Mobingi Alm template body in json string format            |


Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Request body
```bash
{
  "version": "2017-03-03",
  "label": "template version label #2",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "AKIAJ...DZLA",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Web01",
      "provision": {
        "image": "${computed}",
        "instance_type": "m3.medium",
        "instance_count": 2,
        "keypair": true
      }
    }
  ]
}
```

Response Body

```bash
HTTP/1.1 202 Accepted

{
  "status": "success",
  "stack_status": "UPDATE_IN_PROGRESS",
  "template_id": "mo-5447820c870e1-ZgNTSRM8K-tk",
  "version_id": "gCn2JuPhndwxMZuidOER0yyxM8jZB6Vn"
}
```


### Compare Template {#template-compare}

Compares the resource changes between two _Mobingi Alm_ templates.

<div class="callout callout-info">
POST <code>/v3/alm/template/compare</code>
</div>

| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| id       | array        |    conditional    |    items contain template id and version information         |
| body       | array        |    conditional    |   items contain template body source         |



Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Request body
```bash
{
  "id": [
    {
      "mo-5447826c870e7-ZgNTSRM8K-tk": {
        "version": "98O0jK5CQk8gLi14S2SLU8z3JIo3.JPx"
      }
    },
    {
      "mo-5447826c870e7-ZgNTSRM8K-tk": {
        "version": "gCn2JuPhndwxMZuodOER0yyxM8jZB6Vn"
      }
    }
  ]
}
```

Response Body

```bash
HTTP/1.1 202 Accepted

{
  "status": "success",
  "source":{
      "version": "2017-03-03",
      "label": "template version label #1",
      "description": "This template creates a sample stack with EC2 instance on AWS",
      "vendor": {
        "aws": {
          "cred": "AKIAJ...DZLA",
          "region": "ap-northeast-1"
        }
      },
      "configurations": [
        {
          "role": "web",
          "flag": "Web01",
          "provision": {
            "image": "${computed}",
            "instance_type": "t2.micro",
            "instance_count": 1,
            "keypair": true
          }
        }
      ]
  },
  "target": {
      "version": "2017-03-03",
      "label": "template version label #2",
      "description": "This template creates a sample stack with EC2 instance on AWS",
      "vendor": {
        "aws": {
          "cred": "AKIAJ...DZLA",
          "region": "ap-northeast-1"
        }
      },
      "configurations": [
        {
          "role": "web",
          "flag": "Web01",
          "provision": {
            "image": "${computed}",
            "instance_type": "m3.medium",
            "instance_count": 2,
            "keypair": true
          }
        }
      ]
  },
  "diff": {
    "new": [],
    "removed": {
      "configurations\/1\/provision\/volume_type": "${computed}"
    },
    "edited": {
      "label": {
        "oldvalue": "template version label #1",
        "newvalue": "template version label #2"
      },
      "configurations\/provision\/instance_type": {
        "oldvalue": "t2.micro",
        "newvalue": "m3.medium"
      },
      "configurations\/provision\/instance_count": {
        "oldvalue": 1,
        "newvalue": 2
      }
    }
  }
}
```


### List Template {#template-list}

List all _Mobingi Alm_ template versions

<div class="callout callout-info">
GET <code>/v3/alm/template</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| template_id       | string        |   Yes     |  The unique id returned when applying the template     |



Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200 OK

[
  {
    "version_id": "1kk2HiGLxF1fThVLJvC0h6fd5z3QWOiM",
    "latest": true,
    "last_modified": "2017-08-25T10:40:29.000Z",
    "size": "2963"
  },
  {
    "version_id": "gCn2JuPhndwxMZuodOER0yyxM8jZB6Vn",
    "latest": false,
    "last_modified": "2017-08-25T10:20:38.000Z",
    "size": "211"
  },
  {
    "version_id": "98O0jK5CQk8gLi14S2SLU8z3JIo3.JPx",
    "latest": false,
    "last_modified": "2017-08-25T08:48:12.000Z",
    "size": "2940"
  }
]
```


### Describe Template {#template-describe}

Describes the
<div class="callout callout-info">
GET <code>/v3/alm/template/{template_id}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| version_id       | string        |   No     | The id of the template version associated with stack. If empty or "latest" provided, the most updated template version will be returned      |



Request Header
```bash
Authorization: Bearer eyJ0eXAiOiJQiL...CJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body

```bash
HTTP/1.1 200 OK

{
  "version": "2017-03-03",
  "label": "template version label #2",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "AKIAJ...DZLA",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Web01",
      "provision": {
        "image": "${computed}",
        "instance_type": "m3.medium",
        "instance_count": 2,
        "keypair": true
      }
    }
  ]
}
```
