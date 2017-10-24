In order to support various unique functions for different cloud providers, we provide add-ons.

### AWS {#aws}
The ALM-agent enables you to perform specific actions when Auto Scaling Instances or Spot Instances are terminated.

<br>

#### How ALM-agent Work
- Deregisters the instance from the load balancer.
  - After the instance is deregistered, it no longer receives traffic from the load balancer.
- Executes the specified script.
  - If you put the script named `pre_shutdown.sh` under the root (`/`) folder in the Docker Image, the ALM-agent executes the script.

#### Conditions
- Auto Scaling puts the instance into `Terminating:Wait`.
- Amazon EC2 will interrupt Spot Instances.
