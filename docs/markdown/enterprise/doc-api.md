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
| template       | string        | Yes       | Json strings            |

_template_ columns

| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| label       | string        | Yes       | template title            |
| description       | string        | Yes       | template short information            |


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
template: "{alm-template json string}"
```

Response Body:

```json
{
    "success" : "true",
    "templateId" : "xxxxxxxx",
    "versionId" : "xxxxxxxx"
}
```

### Update Template {#templates-update}

<div class="callout callout-info">
PUT <code>/v3/alm/template/{templateId}</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| versionId       | string        |        | Copy from other version            |
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
versionId: "sFVYDoe08fxPjNgYvauYGOYCeXbOTE.dSIGdk="
: "sFVYDoe08fxPjNgYvauYGOYCeXbOTE.dSIGdk="
label: "new label"
description: "new description"
```


Response Body:

```json
{
    "success" : "true",
    "templateId" : "xxxxxxxx",
    "versionId" : "xxxxxxxx"
}
```

### Describe Template {#templates-describe}

<div class="callout callout-info">
GET <code>/v3/alm/template/{templateId}?versionId=XXXXXX</code>
</div>


| Parameters    | Type          | Required  | Detail       |
| ------------- |:-------------:| ---------:| :------------|
| versionId       | string        |        | if need old version.            |



Request Header:

```json
Authorization: Bearer eyJ0eXA...
Content-Type: application/json
```


Response Body:

```json
{
    "templateId": "XXXXXXXXXXXXX",
    "versionId": "XXXXXXXXXXXXXXXXXXX",
    "user_id": "XXXXXXXX",
    "username": "UUUUUUUU",
    "templateBody": {
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
    "versions": {
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
    }
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
        "template_id": "578e0e1b923c9-HBTA5YeeE-testtest",
        "versionId": "qKoTXPV62lP2PEoPF15aj.QKpq3VCyS4",
        "user_id": "578e0e1b923c9",
        "username": "testtest",
        "label": "label test",
        "description": "desc test"
        "vendor": {
            "aws": {
              "cred": "AKIAJ2*********2DZLA"
            }            
        },
        "create_time": "2017-08-23T09:10:13+09:00",
        "update_time": "2017-08-23T09:34:15+09:00",
    },
    {
        ...
    }
]

```
