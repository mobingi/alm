### Overview {#overview}

mobingi-cli is the official command line interface for Mobingi API and services.

To view a list of the available commands, just run mobingi-cli without arguments:

```bash
$ mobingi-cli
Command line interface for Mobingi API and services.

Usage:
  mobingi-cli [command]

Available Commands:
  creds       manage your credentials
  help        help about any command
  login       login to Mobingi API
  rbac        manage role based access control features
  registry    manage your Mobingi docker registry
  reset       reset config to defaults
  stack       manage your stack
  svrconf     manage your server config file
  template    manage your ALM templates
  version     print the version

Flags:
      --token string    access token
      --url string      base url for API
      --rurl string     base url for Docker Registry
      --apiver string   API version (default "v3")
  -f, --fmt string      output format (values depends on command)
  -o, --out string      full file path to write the output
      --indent int      indent padding when fmt is 'json' (default 2)
      --timeout int     timeout in seconds (default 120)
      --verbose         verbose output
      --debug           debug mode when error occurs
  -h, --help            help for mobingi-cli

Use "mobingi-cli [command] --help" for more information about a command.
```

To get help for any command, pass the -h flag to the command. For example, to see help about the stack command:

```bash
$ mobingi-cli stack -h
Manage your infrastructure/application stack.                    

Usage:                                                           
  mobingi-cli stack [flags]                                      
  mobingi-cli stack [command]                                    

Available Commands:                                              
  create      create a stack                                     
  delete      delete a stack                                     
  describe    display stack details                              
  list        list all stacks                                    
  pem         print stack pem file                               
  ssh         ssh to your instance                               
  update      update a stack                                     

Flags:                                                           
  -h, --help   help for stack                                    

Global Flags:                                                    
      --apiver string   API version (default "v3")
      --debug           debug mode when error occurs
  -f, --fmt string      output format (values depends on command)
      --indent int      indent padding when fmt is 'json' (default 2)
  -o, --out string      full file path to write the output
      --rurl string     base url for Docker Registry
      --timeout int     timeout in seconds (default 120)
      --token string    access token
      --url string      base url for API
      --verbose         verbose output

Use "mobingi-cli stack [command] --help" for more information about a command.
```

### Global flags {#global-flags}

Global flags are all optional and can be applied to any subcommand. You can use '=' or whitespace when assigning a value to the flag. This applies to any command's local flags as well. For example, you can login using any of these commands:

```bash
# using the '=' for assignment
$ mobingi-cli login --client-id=foo --client-secret=bar
[mobingi-cli]: info: Login successful.

# using whitespace for assignment
$ mobingi-cli login --client-id foo --client-secret bar
[mobingi-cli]: info: Login successful.
```

* `--token` - The access token to use in the command. By default, mobingi-cli will save your access token to the config file after login (see [login](#login) command).
* `--url` - The base API url to use in the command. By default, this is set to _https://api.mobingi.com_. You can use this flag if you are hosting your own backend. This is used by devs when testing the cli against the dev and test environments.
* `--rurl` - The base registry url to use in the command. This is applicable to Mobingi Registry related commands. By default, this is set to _https://registry.mobingi.com_. This is used by devs when testing the cli against the dev and test environments.
* `--apiver` - Specify the API version used in the current command. The default version is v3. The only other supported version is v2.
* `--fmt, -f` - Output format of the command. Valid values are: _raw_, _json_. Not all commands support this flag.
* `--out, -o` - Full path of the file to write the command output. Not all commands support this flag.
* `--indent` - Padding/indentation (or the number of whitespaces to be added) when the output format used is _json_. By default, this is set to 2.
* `--timeout` - The timeout value (in seconds) for the command's http request (if applicable). By default, this is set to 120 seconds.
* `--verbose` - When set to true, the command will print additional information during the command's execution.
* `--debug` - When set to true, the command will print a stack trace when error occurs during the command's execution.

### command: login {#login}

Log in to Mobingi.

**Flags**

* `--client-id, -i` - Your Mobingi client id.
* `--client-secret, -s` - Your Mobingi client secret.
* `--grant-type, -g` - Grant type. Default value is "password".
* `--username, -u` - Username. You can use your main (master) account to login as root. Or you can use any subuser name.
* `--password, -p` - Password.
* `--endpoints` - Setup endpoints after login. If you have a Mobingi dev or qa account(s), you can set this to _dev_ or _qa_.

This is the first command you need to run to use the other commands. To login, run

```bash
# login as root
$ mobingi-cli login --client-id=foo --client-secret=bar --username=master@mobingi.com --password=1234
[mobingi-cli]: info: Login successful.

# login as subuser
$ mobingi-cli login --client-id=foo --client-secret=bar --username=subuser01 --password=pass
[mobingi-cli]: info: Login successful.

# if you don't want to show your password, remove the --password flag
$ mobingi-cli login --client-id=foo --client-secret=bar --username=subuser01
Password: xxxx
[mobingi-cli]: info: Login successful.
```

If login is successful, cli will create a file _config.yml_ under _$HOME/.mobingi-cli/_ folder that will contain the configuration values set during login. Cli will also attempt to store your credentials in the platform's native store (i.e. Keychain for OSX), if available. If not successful, the retrieved token during login will be saved in the _config.yml_ file. This token has an expiration so you will probably need to relogin at some point when this happens.

For Windows and OSX, cli can use the native credential store directly; wincred for Windows, Keychain for OSX. For Linux, cli uses [pass](https://www.passwordstore.org/) as storage. The following is an example of how to setup pass in Ubuntu systems.

```bash
# install pass
$ sudo apt-get install pass

# generate your own key using gpg2, do not use a passphrase
$ gpg2 --gen-key

# if the cmd seems stuck due to lack of entropy, you can open another window and run the ff cmd:
# dd if=/dev/sda of=/dev/zero

# list your keys
$ gpg2 --list-keys
/home/user/.gnupg/pubring.kbx
------------------------------
pub   rsa2048/5486B0F6 2017-09-22 [SC]
uid         [ultimate] IamGroot <iamgroot@mobingi.com>
sub   rsa2048/CDC4C430 2017-09-22 [E]

# initialize pass (use the pub key id)
$ pass init 5486B0F6

# you can now do a mobingi-cli login ...
```

By default, all endpoints are set to Mobingi production during login. You can use the --endpoints flag to target alternative endpoints. For example, if you have a Mobingi dev account, you can use the following login command:

```bash
$ mobingi-cli login --client-id foo --client-secret bar --username subuser01 --password 1234 --endpoints dev
[mobingi-cli]: info: Login successful.
```

### command: stack list {#stack-list}

List your stacks.

Example:

```bash
$ mobingi-cli stack list
STACK ID                          STACK NAME                   PLATFORM     STATUS              ...
mo-58c2297d25645-q38pTmeey-tk     small lunch behave           AWS          CREATE_COMPLETE     ...
mo-58c2297d25645-PxviFSJQV-tk     chronic leaflet flourish     AWS          CREATE_COMPLETE     ...
```

### command: stack describe {#stack-describe}

Describe a stack.

**Flags**

* `--id` - The stack id to describe.

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

### command: stack create {#stack-create}

Create a stack.

**Flags**

* `--alm-template` - Path to your ALM template. This is required in v3.
* `--vendor` - Stack vendor. For now, only AWS is supported.
* `--cred` - Your vendor credential ID. If not set, cli will try to get your list of credentials and use the first one in the list, if not empty.
* `--region` - Region code. By default, this is set to _ap-northeast-1_ (Tokyo).
* `--nickname` - Your stack's nickname.
* `--arch` - Stack type. Valid values are: "art_single", "art_elb". By default, this is set to "art_elb".
* `--type` - Instance type. By default, this is set to _m3.medium_.
* `--image` - Docker registry path to deploy. If you are using _hub.docker.com_, you can omit the domain part (ex. _grayltc/lamp_). Otherwise, specify the full path (ex. _registry.mobingi.com/wayland/lamp_). By default, this is set to _mobingi/ubuntu-apache2-php7:7.1_.
* `--dhub-user` - Your Docker hub username if repository is private.
* `--dbuh-pass` - Your Docker hub password if repository is private.
* `--min` - Minimum number of instances in your autoscaling group when --arch is set to art_elb. By default, this is set to 2.
* `--max` - Maximum number of instances in your autoscaling group when --arch is set to art_elb. By default, this is set to 10.
* `--spot-range` - Percentage of spot instance to deploy to autoscaling group. For example, if you have a total of 20 instances running and your spot range is 50 (50%), then there will be a fleet of 10 spot instances and 10 on-demand instances. By default, this is set to 50.
* `--code` - Your git repository url. This can be updated anytime. By default, this is set to _github.com/mobingilabs/default-site-php_.
* `--code-ref` - Repository branch. By default, this is set to _master_.
* `--code-privkey` - Private key if git repository is private.
* `--usedb` - Set to true if you want to deploy a database.
* `--dbengine` - Your database engine. Valid values are: "db_mysql", "db_postgresql". Requires --usedb flag.
* `--dbtype` - Database instance/class type. Requires --usedb flag.
* `--dbstorage` - Database storage in GB. Set between 5 to 6144. Requires --usedb flag.
* `--dbread-replica1` - Read replica 1. Requires --usedb flag.
* `--dbread-replica2` - Read replica 2. Requires --usedb flag.
* `--dbread-replica3` - Read replica 3. Requires --usedb flag.
* `--dbread-replica4` - Read replica 4. Requires --usedb flag.
* `--dbread-replica5` - Read replica 5. Requires --usedb flag.
* `--use-elasticache` - Set to true if you want to use elasticache.
* `--elasticache-engine` - Either _Redis_ or _Memcached_. Requires --use-elasticache flag.
* `--elasticache-nodetype` - Elasticache node size. For example, _cache.r3.large_. Requires --use-elasticache flag.
* `--elasticache-nodecount` - If Redis, range is 1 to 6. If Memcached, range is 1 to 20. Requires --use-elasticache flag.

**API v3**

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

**API v2**

Examples:

```bash
$ mobingi-cli stack create --nickname=sample --apiver=v2
$ mobingi-cli stack create --nickname=sample --min=2 --max=2 --apiver=v2
```

### command: stack update {#stack-update}

Update an existing stack.

**Flags**

* `--alm-template` - Path to your updated ALM template file. Required in v3.
* `--id` - The stack id to update.
* `--type` - Instance type. See stack create command for more information.
* `--min` - Minimum number of instances in your autoscaling group. See stack create command for more information.
* `--max` - Maximum number of instances in your autoscaling group. See stack create command for more information.
* `--spot-range` - Percentage of spot instance to deploy to autoscaling group. See stack create command for more information.

**API v3**

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

**API v2**

Examples:

```bash
$ mobingi-cli stack update --id=foo --min=5 --max=20 --apiver=v2
$ mobingi-cli stack update --id=foo --spot-range=25 --apiver=v2
```

### command: stack delete {#stack-delete}

Delete a stack.

**Flags**

* `--id` - The stack id to delete.

Example:

```bash
$ mobingi-cli stack delete --id mo-58c2297d25645-GbdINZdY-tk
[mobingi-cli]: info: [200 OK] return payload:
{
  "status": "DELETE_IN_PROGRESS"
}
```

### command: stack ssh {#stack-ssh}

Try to establish an ssh connection to your instances.

**Flags**

* `--id` - The stack id the instance belongs to.
* `--ip` - The IP address of the instance you want to connect.
* `--flag` - The configuration flag.
* `--user` - The ssh username. By default, this is set to _ec2-user_. Set to _root_ when vendor is Alibaba Cloud.
* `--browser` - Try to open the url using the user's default browser.

Examples:

```bash
# open an ssh connection via cli
$ mobingi-cli stack ssh --id mo-58c2297d25645-Sd2aHRDq0-tk --ip 54.238.234.202 --flag web01
[ec2-user@ip-10-0-1-96 ~]$ pwd
/home/ec2-user
[ec2-user@ip-10-0-1-96 ~]$ exit
logout
Connection to 54.238.234.202 closed.

# open an ssh connection using default browser
$ mobingi-cli stack ssh --id mo-58c2297d25645-Sd2aHRDq0-tk --ip 54.238.234.202 --flag web01 --browser
[mobingi-cli]: info: open link with a browser (if not opened automatically): \
https://sesha3.mobingi.com:port/some-random-link/
```

### command: stack exec {#stack-exec}

Try to execute a bash script to one or more instances.

**Flags**

* `--target` - The target instance to execute the script. The format is stack-id|ip:flag. This flag can be specified more than once.
* `--script` - The script file to execute.

Examples:

```bash
# for example, we have a script with the following contents (stored in home folder as test.sh):
#!/bin/bash
pwd
uname -a
env

# run the script on a single instance
$ mobingi-cli stack exec \
    --target "mo-58c2297d25645-rkIEPmust-tk|root@47.74.5.170:Single" \
    --script ~/test.sh
[mobingi-cli]: info: [0]output: mo-58c2297d25645-rkIEPmust-tk, instance: root@47.74.5.170, flag: Single
/root
Linux iZ6weeq9e4ktok8f9o2910Z 3.10.0-514.26.2.el7.x86_64 #1 SMP Tue Jul 4 15:04:05 UTC 2017 x86_64 x86_64 x86_64 GNU/Linux
XDG_SESSION_ID=43623
SHELL=/bin/bash
SSH_CLIENT=54.238.178.1 45328 22
USER=root
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin
MAIL=/var/mail/root
PWD=/root
LANG=en_US.UTF-8
HOME=/root
SHLVL=2
LOGNAME=root
SSH_CONNECTION=54.238.178.1 45328 10.1.0.106 22
LESSOPEN=||/usr/bin/lesspipe.sh %s
XDG_RUNTIME_DIR=/run/user/0
_=/usr/bin/env

# run the same script to an aws ec2 instance and an alibabacloud vm
$ mobingi-cli stack exec \
    --target "mo-58c2297d25645-rkIEPmust-tk|root@47.74.5.170:Single" \
    --target "mo-58c2297d25645-M5EIHEaOC-tk|ec2-user@13.230.9.8:web0" \
    --script ~/test.sh
[mobingi-cli]: info: [0]output: mo-58c2297d25645-rkIEPmust-tk, instance: root@47.74.5.170, flag: Single
/root
Linux iZ6weeq9e4ktok8f9o2910Z 3.10.0-514.26.2.el7.x86_64 #1 SMP Tue Jul 4 15:04:05 UTC 2017 x86_64 x86_64 x86_64 GNU/Linux
XDG_SESSION_ID=43631
SHELL=/bin/bash
SSH_CLIENT=54.238.178.1 45386 22
USER=root
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin
MAIL=/var/mail/root
PWD=/root
LANG=en_US.UTF-8
HOME=/root
SHLVL=2
LOGNAME=root
SSH_CONNECTION=54.238.178.1 45386 10.1.0.106 22
LESSOPEN=||/usr/bin/lesspipe.sh %s
XDG_RUNTIME_DIR=/run/user/0
_=/usr/bin/env

[mobingi-cli]: info: [1]output: mo-58c2297d25645-M5EIHEaOC-tk, instance: ec2-user@13.230.9.8, flag: web0
/home/ec2-user
Linux ip-10-0-1-63 4.9.51-10.52.amzn1.x86_64 #1 SMP Fri Sep 29 01:16:19 UTC 2017 x86_64 x86_64 x86_64 GNU/Linux
LESS_TERMCAP_mb=
LESS_TERMCAP_md=
LESS_TERMCAP_me=
SHELL=/bin/bash
SSH_CLIENT=54.238.178.1 37174 22
EC2_AMITOOL_HOME=/opt/aws/amitools/ec2
LESS_TERMCAP_ue=
USER=ec2-user
EC2_HOME=/opt/aws/apitools/ec2
LESS_TERMCAP_us=
PATH=/usr/local/bin:/bin:/usr/bin:/opt/aws/bin
MAIL=/var/mail/ec2-user
PWD=/home/ec2-user
JAVA_HOME=/usr/lib/jvm/jre
LANG=en_US.UTF-8
AWS_CLOUDWATCH_HOME=/opt/aws/apitools/mon
HOME=/home/ec2-user
SHLVL=2
AWS_PATH=/opt/aws
AWS_AUTO_SCALING_HOME=/opt/aws/apitools/as
LOGNAME=ec2-user
SSH_CONNECTION=54.238.178.1 37174 10.0.1.63 22
AWS_ELB_HOME=/opt/aws/apitools/elb
LESSOPEN=||/usr/bin/lesspipe.sh %s
LESS_TERMCAP_se=
_=/bin/env
```

### command: stack pem {#stack-pem}

Print the stack's pem file (and save to file optionally), if available. Useful if you want to connect to your instances using other tools.

**Flags**

* `--id` - The stack id to query.
* `--flag` - The configuration flag.


Example:

```bash
# print pem file
$ mobingi-cli stack pem --id mo-58c2297d25645-Sd2aHRDq0-tk --flag web01
[mobingi-cli]: info: payload:
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAiy5kdqROYbjke0BE8rcT7qUtSKyaaIgqiJLYxlduov2wvnRHSo5O8m67v8UD
Pkxz4fR/gQXYcpV4/T/3zqTVaGcVNK8ZCE1jRfKt/5QFQkPOJRkDWZZzQqSwUMhnMiK1iE+33fmp
ITvktdL9OMT0RXjZ4qKq+aifaY9D0XzbR3HWLFcWZ+0tmzUTJDM8F6LivsPUjR8uitiic7KXvlDV
...
-----END RSA PRIVATE KEY-----

# print pem file and save to home directory as test.pem
$ mobingi-cli stack pem --id mo-58c2297d25645-Sd2aHRDq0-tk --flag web01 --out ~/test.pem
[mobingi-cli]: info: payload:
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAiy5kdqROYbjke0BE8rcT7qUtSKyaaIgqiJLYxlduov2wvnRHSo5O8m67v8UD
Pkxz4fR/gQXYcpV4/T/3zqTVaGcVNK8ZCE1jRfKt/5QFQkPOJRkDWZZzQqSwUMhnMiK1iE+33fmp
ITvktdL9OMT0RXjZ4qKq+aifaY9D0XzbR3HWLFcWZ+0tmzUTJDM8F6LivsPUjR8uitiic7KXvlDV
...
-----END RSA PRIVATE KEY-----

# you can now use ssh tool to connect your instance
$ ssh -i ~/test.pem user@ipaddr
```

### command: template versions {#template-versions}

List available template versions of a stack.

**Flags**

* `--id` - The stack id owning the template versions to be listed.

Example:

```bash
# list stacks first to get the stack id
$ mobingi-cli stack list
STACK ID                          STACK NAME                   PLATFORM     STATUS              ...
mo-58c2297d25645-q38pTmeey-tk     small lunch behave           AWS          CREATE_COMPLETE     ...
mo-58c2297d25645-PxviFSJQV-tk     chronic leaflet flourish     AWS          CREATE_COMPLETE     ...
# then list the template versions
$ mobingi-cli template versions --id mo-58c2297d25645-PxviFSJQV-tk
VERSION ID                           LATEST     LAST MODIFIED                     SIZE
jbyW_PxMAauQmOS31dUhij4KIqHAtqW2     true       Wed, 30 Aug 2017 02:32:43 UTC     472
1xoPd.cg3juHK94vC8IdUh1bexx7sQ1T     false      Tue, 29 Aug 2017 09:47:50 UTC     453
```

### command: template compare {#template-compare}

Compare two template versions.
# EE {.label .label-primary}


You can compare template versions from the same stack, versions from different stacks, or a local template file to a specific template version.

**Flags**

* `--src-sid` - The stack id of the first (or source) template. This flag is required.
* `--src-vid` - The version id of the first (or source) template. This flag is required.
* `--tgt-sid` - The stack id of the second (or target) template. If not set, cli will assume you are comparing templates of the same stack.
* `--tgt-vid` - The version id of the second (or target) template. This flag is required if you are not providing the --tgt-body flag.
* `--tgt-body` - Path of the template file you want to compare to the first (or source) template. If you set this flag, do not set the --tgt-sid and the --tgt-vid flags as they are ignored.

Example:

```bash
# using the examples above
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

### command: rbac describe {#rbac-describe}

List all defined role(s) or per-user role(s). Only your root account has the permissions to run this command.

If --user is not provided, this command will list all defined roles.

**Flags**

* `--user` - Subuser name. Optional.

### command: rbac sample {#rbac-sample}

Print a sample role.

This is useful when creating roles and you want something to start with. You can use this command to write to a file (using the --out global flag), edit the contents and use the file for role creation.

Example:

```bash
$ mobingi-cli rbac sample --out=/home/user/sample.json
{
  "Version": "2017-05-05",
  "Statement": [
    {
      "Effect": "Deny",
      "Action": [
        "stack:describeStacks"
      ],
      "Resource": [
        "mrn:alm:stack:mo-xxxxxxx"
      ]
    },
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
[mobingi-cli]: info: sample written to /home/user/sample.json
```

### command: rbac create {#rbac-create}

Define a role.

**Flags**

* `--type` - Create type. Valid values are _role_ and _user_. Default is _role_.
* `--name` - Role name when --type is _role_.
* `--scope` - Path to role file.
* `--allow-all` - When set to true, --scope is ignored, the resulting role will allow all actions to all resources.

Example:

```bash
# use the sample generated in the previous command
$ mobingi-cli rbac create --name testrole --scope /home/user/sample.json
[mobingi-cli]: info: 200 OK
{
  "status":"success",
  "role_id":"morole-58c2297d25645-F6HUEJG57"
}
```

### command: rbac attach {#rbac-attach}

Attach a role to a user.

**Flags**

* `--user` - The subuser name to attach the role to.
* `--role-id` - The role id to attach.

Example:

```bash
$ mobingi-cli rbac attach --user subuser --role-id morole-58c2297d25645-BtXGMSRsI
[mobingi-cli]: info: 200 OK
{
  "status": "success",
  "user_role_id": "mour-subuser-icxUQ91SO"
}
```

### command: rbac delete {#rbac-delete}

Delete a role.

**Flags**

* `--role-id` - The role id to delete. You can get the role id from the _describe_ command.

### command: svrconf show {#svrconf-show}

Show a stack's serverconfig (server configuration) contents. Starting from v3, server config options are replaced by ALM templates. The following commands are still valid for v2.

**Flags**

* `--id` - The stack id to query.

Example:

```bash
$ mobingi-cli svrconf show --id=foo --apiver=v2
```

### command: svrconf update {#svrconf-update}

Update a stack's serverconfig (server configuration).

**Flags**

* `--id` - The stack id to update.
* `--env` - A comma-separated key/value pair(s) for environment variables. If you have whitespaces in the input, enclose it with double quotes. You can also set this flag to "null" to clear all environment variables.
* `--filepath` - New filepath value if you want to update your filepath.

Examples:

```bash
# env examples
$ mobingi-cli svrconf update --id=foo --env=KEY1:value1,KEY2:value2,KEYx:valuex --apiver=v2
$ mobingi-cli svrconf update --id=foo --env="KEY1: value1, KEY2: value2, KEYx: valuex" --apiver=v2
$ mobingi-cli svrconf update --id=foo --env=null --apiver=v2
# filepath example
$ mobingi-cli svrconf update --id=foo --filepath=git://github.com/mobingilabs/default --apiver=v2
```

Note that when you provide update options simultaneously (for example, you provide `--env=FOO:bar` and `--filepath=test` at the same time), the tool will send each option as a separate request.

### command: creds list {#creds-view}

List vendor credentials.

**Flags**

* `--vendor` - The vendor to list credentials. Valid values: _aws_, _alicloud_. Default value is _aws_.


Examples:

```bash
$ mobingi-cli creds list
VENDOR     ID                       ACCOUNT     LAST MODIFIED
aws        xxxxxxxxxxxxxxxxxxxx     user        Wed, 05 Jul 2017 07:52:14 UTC
```

### command: registry catalog {#registry-list-catalog}

List images under logged in username.

This command is inherently slow.

Registry related commands will use the login user/password credentials, if native store is supported. Otherwise, you will have to provide the user/password credentials using the --username and --password flags.

**Flags**

* `--username` - Username (Mobingi account subuser)
* `--password` - Password (Mobingi account subuser)
* `--service` - Authentication service. By default, this is set to "Mobingi Docker Registry".
* `--scope` - Authentication scope. See https://docs.docker.com/registry/spec/auth/scope/ for more information on scopes.

Examples:

```bash
# user/password credentials are stored in native store
$ mobingi-cli registry catalog
[mobingi-cli]: info: Catalog list for user: subuser01
subuser01/foo

# no native store support
$ mobingi-cli registry catalog --username=subuser01 --password=xxxxxx
[mobingi-cli]: info: Catalog list for user: subuser01
subuser01/foo
```

### command: registry tags {#registry-list-tags}

List image tags.

**Flags**

* `--username` - Username (Mobingi account subuser)
* `--password` - Password (Mobingi account subuser)
* `--service` - Authentication service. By default, this is set to "Mobingi Docker Registry".
* `--scope` - Authentication scope. See https://docs.docker.com/registry/spec/auth/scope/ for more information on scopes.
* `--image` - Image name to list.

Example:

```bash
$ mobingi-cli registry tags --image foo
IMAGE                   TAG
subuser01/foo           latest
subuser01/foo           2.1
```

### command: registry manifest {#registry-tag-manifest}

Display a tag's manifest.

**Flags**

* `--username` - Username (Mobingi account subuser)
* `--password` - Password (Mobingi account subuser)
* `--service` - Authentication service. By default, this is set to "Mobingi Docker Registry".
* `--scope` - Authentication scope. See https://docs.docker.com/registry/spec/auth/scope/ for more information on scopes.
* `--image` - Image tag to query. Format is _image:tag_.

Example:

```bash
$ mobingi-cli registry manifest --image foo:latest
{
   "schemaVersion": 1,
   "name": "subuser01/foo",
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

### command: registry delete {#registry-tag-delete}

Delete a tag.

**Flags**

* `--username` - Username (Mobingi account subuser)
* `--password` - Password (Mobingi account subuser)
* `--service` - Authentication service. By default, this is set to "Mobingi Docker Registry".
* `--scope` - Authentication scope. See https://docs.docker.com/registry/spec/auth/scope/ for more information on scopes.
* `--image` - Image tag to query. Format is _image:tag_.

Example:

```bash
$ mobingi-cli registry delete --username=subuser1 --password=xxxxxx \
      --image=foo:latest --apiver=v2
```

### command: registry token {#registry-get-token}

Get an access token for Mobingi Docker Registry access.

**Flags**

* `--username` - Username (Mobingi account subuser)
* `--password` - Password (Mobingi account subuser)
* `--service` - Authentication service. By default, this is set to "Mobingi Docker Registry".
* `--scope` - Authentication scope. See https://docs.docker.com/registry/spec/auth/scope/ for more information on scopes.

Example:

```bash
$ mobingi-cli registry token \
      --username=foo \
      --password=bar \
      --service="Mobingi Docker Registry" \
      --scope="repository:foo/container:*"
```

This is useful when you want to access the registry directly using other tools. For example, you can use the token when using Docker Registry API via `curl`.

```bash
$ curl -H "Authorization: Bearer token" \
      -H "Accept application/vnd.docker.distribution.manifest.v2+json" \
      https://registry.mobingi.com/v2/foo/container/manifests/latest
```

### command: reset {#reset}

Reset all configuration values to default. It will also delete all credential information stored in the platform's native store.

Example:

```bash
$ mobingi-cli reset
$ cat ~/.mobingi-cli/config.yml
access_token: ""
api_url: https://api.mobingi.com
registry_url: https://registry.mobingi.com
api_version: v3
indent: 2
timeout: 120
verbose: false
debug: false
```

### command: version {#version}

Prints the cli version.

```bash
$ mobingi-cli version
v0.2.3-beta
```
