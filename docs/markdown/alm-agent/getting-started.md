### Prerequisites {#prerequisites}
Alm-agent includes the following prerequisites.

|Requirement|Description|
| --------- | --------- |
| Supported Operating System | Instances must run a supported version of Linux. <br> Amazon Linux 2016.09 or later, Ubuntu Server 14.04 LTS or later, CentOS7 or later, Red Hat Enterprise Linux(RHEL) 7 or later. |
| Internet Access | If you use something services on the Internet (e.g. GitHub, DockerHub, etc..), verify that your instances have outbound Internet access. |
| Docker | Instances should have Docker installed. |
| Git | Instances should have Git installed. |


### Install ALM agent {#install-alm-agent}
There are two ways to installing Alm-agent:

1. Using a precompiled binary
2. Installing from source

Downloading a precompiled binary is easist.


#### _**Using a precompiled binarys**_
Alm-agent is distributed as a binary package. To install Alm-agent, you can download it from this [link](https://download.labs.mobingi.com/alm-agent/master/current/alm-agent.tgz).

Alm-agent is packages as a tgz archive. After downloading Alm-agent, untgz the package. Alm-agent runs as a single binary named `alm-agent`.

```bash
$ mkdir -p /opt/mobingi/alm-agent /opt/mobingi/etc
$ wget https://download.labs.mobingi.com/alm-agent/develop/current/alm-agent.tgz
$ tar xvzf alm-agent.tgz -C /opt/mobingi/alm-agent
$ ln -sf /opt/mobingi/alm-agent/v* /opt/mobingi/alm-agent/current
```

#### _**Installing from source**_
We prepare Vagrantfile to compile from source. You will need VirtualBox and Vagrant installed. You can compile in virtual machine.


```bash
$ git clone https://github.com/mobingi/alm-agent
$ cd alm-agent
$ vagrant up default
$ vagranth ssh default
vagrant $ cd /home/vagrant/src/github.com/mobingi/alm-agent/
vagrant $ make build
```

### Verifying the Installation {#verifying-the-installation}
After installing Alm-agent, verify the installation worked and checking that `almagent` is available.

By executing `alm-agent` you should see the help output similar to this:

```bash
$ alm-agent
NAME:
   alm-agent

USAGE:
   alm-agent [global options] command [command options] [arguments...]

VERSION:
   v0.3.1504270893

COMMANDS:
     register  initialize alm-agent and start containers
     ensure    start or update containers
     stop      stop active container
     noop      run without container actions.
     help, h   Shows a list of commands or help for one command

GLOBAL OPTIONS:
   --autoupdate, -U                  auto update before run
   --disablereport, -N               Do not send crash report to rollbar.
   --provider Provider, -P Provider  set Provider (default: "aws")
   --verbose, -V                     show debug logs
   --help, -h                        show help
   --version, -v                     print the version
```

