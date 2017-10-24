### Prerequisites {#prerequisites}
ALM-agent includes the following prerequisites.

|Requirement|Description|
| --------- | --------- |
| Supported Operating System | Instances must run on a supported version of Linux. <br> Amazon Linux 2016.09 or later, Ubuntu Server 14.04 LTS or later, CentOS7 or later, Red Hat Enterprise Linux(RHEL) 7 or later. |
| Internet Access | If your server configuration design requires services to access the public Internet (e.g. GitHub, DockerHub, etc..), verify that your instances have outbound Internet access first. |
| Docker | Instances should have Docker installed. |
| Git | Instances should have Git installed. |


### Install ALM agent {#install-alm-agent}
There are two ways to installing ALM-agent:

1. Using a precompiled binary
2. Installing from source

Download and install from a precompiled binary is the recommended option.


#### _**Using a precompiled binarys**_
ALM-agent is distributed as a binary package. To install ALM-agent, you can download it from this [link](https://download.labs.mobingi.com/alm-agent/master/current/alm-agent.tgz).

ALM-agent is packaged as a tgz archive. After downloading ALM-agent, untgz the package. ALM-agent runs as a single binary named `alm-agent`.


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

After installing ALM-agent, verify the installation works and check that `alm-agent` is available.


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
