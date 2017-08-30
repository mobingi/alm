### Login {#login}

This is the first command you need to run to use the other commands. To login, run

```bash
$ mobingi-cli login --client-id=foo --client-secret=bar
[mobingi-cli]: info: Login successful.
```

This will create a file `config.yml` under `$HOME/.mobingi-cli/` folder that will contain the access token to be used for your subsequent commands, alongside other configuration values.

### Stack operations {#stackops}

#### List stacks {#stack-list}

Examples:

```bash
$ mobingi-cli stack list
STACK ID                          STACK NAME                   PLATFORM     STATUS              ...
mo-58c2297d25645-q38pTmeey-tk     small lunch behave           AWS          CREATE_COMPLETE     ...
mo-58c2297d25645-PxviFSJQV-tk     chronic leaflet flourish     AWS          CREATE_COMPLETE     ...
```

#### Describe a stack {#stack-describe}

Example:

```bash
$ mobingi-cli stack describe --id mo-58c2297d25645-PxviFSJQV-tk
{
  "auth_token": "...",
  "update_time": "2017-08-30T11:32:42+09:00",
  "user_id": "...",
  "configuration": {
    "description": "This template creates a sample stack with EC2 instance on AWS",
    "label": "template version label #1",
    "version": "2017-03-03",
    "vendor": {
      ...
    },
    "configurations": [
      {
        ...
      }
    ],
    "AWS_ACCOUNT_NAME": "..."
  },
  "nickname": "chronic leaflet flourish",
  "create_time": "2017-08-29T18:47:49+09:00",
  "stack_outputs": [],
  "stack_id": "mo-58c2297d25645-PxviFSJQV-tk",
  "stack_status": "CREATE_COMPLETE",
  "version_id": "jbyW_PxMAauQmOS31dUhij4KIqHAtqW2",
  "instances": []
}   
```

#### Create a stack {#stack-create}

<div class="callout callout-info">
API v3
</div>

Starting in v3, we create stacks using ALM templates. Below is an example of a very simple template that creates a single EC2 instance:

```bash
{
  "version": "2017-03-03",
  "label": "template version label #1",
  "description": "This template creates a sample stack with EC2 instance on AWS",
  "vendor": {
    "aws": {
      "cred": "** Your AWS Security Key ID **",
      "secret": "** Your AWS Security Key Secret, remove line if you have a Mobingi account **",
      "region": "ap-northeast-1"
    }
  },
  "configurations": [
    {
      "role": "web",
      "flag": "Single1",
      "provision": {
        "instance_type": "t2.micro",
        "instance_count": 1,
        "keypair": false,
        "subnet": {
          "cidr": "10.0.1.0/24",
          "public": true,
          "auto_assign_public_ip": true
        },
        "availability_zone": "ap-northeast-1c"
      }
    }
  ]
}
```

Example:

```bash
$ mobingi-cli stack create --alm-template=/home/user/aws-single-ec2.json
[mobingi-cli]: info: [201 Created] return payload:
{
  "status": "success",
  "stack_status": "CREATE_IN_PROGRESS",
  "stack_id": "mo-58c2297d25645-GbdINZdY-tk",
  "version_id": "5RnOOvRQ4U52hpY89o_._ArIXgu_xzzg"
}
```

<div class="callout callout-info">
API v2
</div>

You can run `$ mobingi-cli stack create -h` to see the defaults.

Examples:

```bash
$ mobingi-cli stack create --nickname=sample
$ mobingi-cli stack create --nickname=sample --min=2 --max=2
```

If the `--cred` option is not provided (just like in the examples above), cli will attempt to get your list of credentials and use the first one (if more than one). You can view your credentials list using the command:

```bash
$ mobingi-cli creds list
```

#### Update stack {#stack-update}

<div class="callout callout-info">
API v3
</div>

Similar to stack creation, you only need to update some parts of your ALM template to update your stack.

```bash
$ mobingi-cli stack update --id mo-58c2297d25645-q38pTmeey-tk \
      --alm-template /home/user/aws-single_ec2_update.json
[mobingi-cli]: info: [202 Accepted] return payload:
{
  "status": "success",
  "stack_status": "UPDATE_IN_PROGRESS",
  "stack_id": "mo-58c2297d25645-q38pTmeey-tk",
  "version_id": "yypuLitarqIWhMoITLolNOh79fED6QME"
}
```

<div class="callout callout-info">
API v2
</div>

Examples:

```bash
$ mobingi-cli stack update --id=foo --min=5 --max=20
$ mobingi-cli stack update --id=foo --spot-range=25
```

#### Delete a stack {#stack-delete}

Example:

```bash
$ mobingi-cli stack delete --id mo-58c2297d25645-GbdINZdY-tk
[mobingi-cli]: info: [200 OK] return payload:
{
  "status": "DELETE_IN_PROGRESS"
}
```

### ALM template operations {#templateops}

#### List stack template versions {#template-versions}

Example:

```bash
$ mobingi-cli stack list
STACK ID                          STACK NAME                   PLATFORM     STATUS              ...
mo-58c2297d25645-q38pTmeey-tk     small lunch behave           AWS          CREATE_COMPLETE     ...
mo-58c2297d25645-PxviFSJQV-tk     chronic leaflet flourish     AWS          CREATE_COMPLETE     ...

$ mobingi-cli template versions --id mo-58c2297d25645-PxviFSJQV-tk
VERSION ID                           LATEST     LAST MODIFIED                     SIZE
jbyW_PxMAauQmOS31dUhij4KIqHAtqW2     true       Wed, 30 Aug 2017 02:32:43 UTC     472
1xoPd.cg3juHK94vC8IdUh1bexx7sQ1T     false      Tue, 29 Aug 2017 09:47:50 UTC     453
```

#### Compare template versions {#template-compare}

You can compare template versions from the same stack, versions from different stacks, or a local template file to a specific template version.

Example (based from example above):

```bash
$ mobingi-cli template compare --src-sid mo-58c2297d25645-PxviFSJQV-tk \
      --src-vid jbyW_PxMAauQmOS31dUhij4KIqHAtqW2 \
      --tgt-vid 1xoPd.cg3juHK94vC8IdUh1bexx7sQ1T
[mobingi-cli]: info: diff:
{
  "new": [],
  "removed": [],
  "edited": {
    "label": {
      "oldvalue": "template version label #1",
      "newvalue": "template version label #1 (update)"
    },
    "description": {
      "oldvalue": "This template creates a sample stack with EC2 instance on AWS",
      "newvalue": "This template creates a sample stack with EC2 instance on AWS (update)"
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
```

To view help information, run the command:

```bash
$ mobingi-cli template compare -h
```

### Server config operations {#svrconfops}

Server config options are replaced by ALM templates starting from v3. The following commands are still valid for v2.

<div class="callout callout-info">
API v2
</div>

#### Show server config {#svrconf-show}

Example:

```bash
$ mobingi-cli svrconf show --id=foo
```

You can get the stack id from the `stack list` command.

#### Update server config {#svrconf-update}

Examples:

```bash
$ mobingi-cli svrconf update --id=foo --env=KEY1:value1,KEY2:value2,KEYx:valuex
```

If you have whitespaces in the input, enclose it with double quotes

```bash
$ mobingi-cli svrconf update --id=foo --env="KEY1: value1, KEY2: value2, KEYx: valuex"
```

To clear all environment variables, set `--env=null` option

```bash
$ mobingi-cli svrconf update --id=foo --env=null
```

To update server config filepath, run

```bash
$ mobingi-cli svrconf update --id=foo --filepath=git://github.com/mobingilabs/default
```

Note that when you provide update options simultaneously (for example, you provide `--env=FOO:bar` and `--filepath=test` at the same time), the tool will send each option as a separate request.

### Vendor credentials {#creds}

#### View vendor credentials {#creds-view}

Examples:

```bash
$ mobingi-cli creds list
VENDOR     ID                       ACCOUNT     LAST MODIFIED
aws        xxxxxxxxxxxxxxxxxxxx     user        Wed, 05 Jul 2017 07:52:14 UTC
```

### Mobingi Docker registry {#registry}

#### List registry catalog {#registry-list-catalog}

Example:

```bash
$ mobingi-cli registry catalog --username=subuser1 --password=xxxxxx --apiver v2
subuser1/foo
```

Note that this command is inherently slow.

#### List image tags {#registry-list-tags}

Example:

```bash
$ mobingi-cli registry tags --username=subuser1 --password=xxxxxx --image foo --apiver v2
IMAGE                  TAG
subuser1/foo           latest
```

#### Print tag manifest {#registry-tag-manifest}

Example:

```bash
$ mobingi-cli registry manifest --username subuser1 --password xxxxxx \
      --image foo:latest --apiver v2
{
   "schemaVersion": 1,
   "name": "subuser1/foo",
   "tag": "latest",
   "architecture": "amd64",
   "fsLayers": [
      {
         "blobSum": "sha256:a3ed95caeb02ffe68cdd9fd84406680ae93d633cb16422d00e8a7c22955b46d4"
      },
      ...
   ],
   "history": [
      {
         "v1Compatibility": "..."
      },
      ...
   ],
   "signatures": [
      {
         "header": {
            "jwk": {
               ...
            },
            "alg": "ES256"
         },
         "signature": "...",
         "protected": "..."
      }
   ]
}
```

You can also write the output to a file via the `--fmt=full_path_to_file` option.

#### Delete a tag {#registry-tag-delete}

Example:

```bash
$ mobingi-cli registry delete --username=subuser1 --password=xxxxxx \
      --image=foo:latest --apiver v2
```

#### Get token for Docker Registry API {#registry-get-token}

To get token for Docker Registry API access, run

```bash
$ mobingi-cli registry token \
      --username=foo \
      --password=bar \
      --service="Mobingi Docker Registry" \
      --scope="repository:foo/container:*"
```

where `username` is a subuser under your Mobingi account. You can also remove `--service`, `--username` and/or `--password`.

```bash
$ mobingi-cli registry token --scope="repository:foo/container:*"
Username:
Password:
```

By default, it will only print the token value. To print the raw JSON output, append the `--fmt=raw` option.

This is useful when you want to access the registry directly using other tools. For example, you can use the token when using Docker Registry API via `curl`.

```bash
$ curl -H "Authorization: Bearer token" \
      -H "Accept application/vnd.docker.distribution.manifest.v2+json" \
      https://registry.mobingi.com/v2/foo/container/manifests/latest
```

### Verbose output {#verbose}

You can use the global `--verbose` option if you want to see more information during the command execution.
