### API Endpoint {#end-point}

<div class="callout callout-info">
  <p>https://api.mobingi.com</p>
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


### Verify Template {#templates-verify}

<div class="callout callout-info">
POST <code>/v3/alm/template/verify</code>
</div>

Request Header
```
Authorization: Bearer eyJ0eXAiOiJQiLCJhbGciOMeXzQfME
Content-Type: application/json
```

Response Body
```json
{
    "..":".."
}
```
