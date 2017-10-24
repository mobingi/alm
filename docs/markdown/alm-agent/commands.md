### register {#register}
Initialize ALM-agent self register and start containers.

The necessary folders for ALM-agent are created, and if the provider is any value other than `localtest`, cron job will be created. Then, ALM-agent starts the containers.


```bash
$ alm-agent register -h
NAME:
   alm-agent register - initialize alm-agent and start containers

USAGE:
   alm-agent register [command options] [arguments...]

OPTIONS:
   --config FILE, -c FILE        Load configuration from FILE (default: "/opt/mobingi/etc/alm-agent.cfg")
   --serverconfig URL, --sc URL  Load ServerConfig from URL. ask to API by default
```

### ensure {#ensure}

Start or update containers.


```bash
$ alm-agent ensure -h
NAME:
   alm-agent ensure - start or update containers

USAGE:
   alm-agent ensure [command options] [arguments...]

OPTIONS:
   --config FILE, -c FILE        Load configuration from FILE (default: "/opt/mobingi/etc/alm-agent.cfg")
   --serverconfig URL, --sc URL  Load ServerConfig from URL. ask to API by default
```


### stop {#stop}
Stop active containers.


```bash
$ alm-agent stop -h
NAME:
   alm-agent stop - stop active container

USAGE:
   alm-agent stop [command options] [arguments...]

OPTIONS:
   --config FILE, -c FILE        Load configuration from FILE (default: "/opt/mobingi/etc/alm-agent.cfg")
   --serverconfig URL, --sc URL  Load ServerConfig from URL. ask to API by default
```


### noop {#noop}

Run without container actions.

```bash
$ alm-agent noop -h
NAME:
   alm-agent noop - run without container actions.

USAGE:
   alm-agent noop [command options] [arguments...]

OPTIONS:
   --config FILE, -c FILE        Load configuration from FILE (default: "/opt/mobingi/etc/alm-agent.cfg")
   --serverconfig URL, --sc URL  Load ServerConfig from URL. ask to API by default
```

### help {#help}

Shows a list of commands or help for one command.

```bash
$ alm-agent help
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
