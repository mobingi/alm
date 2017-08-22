### Endpoint {#end-point}

http:// `INSTALLATION_PATH` /api

### Versioning {#versioning}

The current released API (CE) version is `v3`.

### Authentication {#authentication}

_Mobingi CE (Community Edition) doesn't support authentication over API requests.
In order to interact with the API via secure HTTPS protocol, you must implement on your own. Or you can try Mobingi EE (Enterprise Edition) which handles this through __OAuth__ for you_.


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
