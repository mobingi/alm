# API Source

The source folder for Mobingi RESTful API.

# Installation

__Attention: This installation is NOT SSL based, and since the request body may contain sensitive information such as your cloud credentials, it's your obligation to secure the HTTP transactions via public internet.__

In order to make this API to work, you'll need to do the followings on your server:

1. Create a folder named `.mobingi` under your home directory (this is where all stack and template information are stored):

```
$ cd ~
$ mkdir .mobingi
```

2. Run php composer to install dependencies:

```
$ cd mobingi/api
$ php composer.phar install
```

3. Configure your Apache or Nginx server then accessing API with the following path:

```
http://{your_server_ip_address}/api
```


# Tests

1. Copy and rename `mobingi/api/tests/phpunit.xml.dist` to `mobingi/api/tests/phpunit.xml` and save it.

2. Open `mobingi/api/tests/phpunit.xml` and set values for the following items. _(Please note that current version only supports AWS, so you only need to provide AWS test credentials here)_

```
<phpunit bootstrap="autoload.php">
    <php>
        <env name="TEST_USER_ID"              value="" /> <= Your mobingi's UserID
        <env name="TEST_CREDENTIAL_ID"        value="" /> <= Your AWS access key id
        <env name="TEST_CREDENTIAL_SECRET"    value="" /> <= Your AWS secret key
    </php>
    <testsuites>
...
```

3. To execute all tests, run:

```
$ cd mobingi/api/tests
$ phpunit
```

in the current directory.

For more information on how to use PHPUnit, please refer to [PHPUnit](https://phpunit.de/getting-started.html) website.


# Clean

__You need to pay extra attention when cleaning up if you have already deployed stacks through Mobingi ALM:__

- All information are stored in `~/.mobingi/*` directory files. So if the folder got deleted or your server (hosting this API script) got replaced, all information will be lost.
- Resources such as server nodes (ec2), VPC, subnets, keypairs, load-balancers, etc has been provisioned to your cloud accounts. You need to completely delete them first.

### Delete Resources
To delete already provisioned resources, the best way is to delete the stack through Mobingi ALM's UI console. Optionally, you can log into your cloud account's console (e.g: AWS console) to manually delete all resources. Please be more carefully that __you may be charged__ by cloud vendors for running resources.
