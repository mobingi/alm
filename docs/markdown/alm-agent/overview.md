### What is ALM-agent? {#what-is-alm-agent}
The ALM-agent is software for Mobingi ALM. ALM-agent is the primary component of container management.

ALM-agent runs on instances, manages Docker container and deploys code to instance on behalf of you.

ALM-agent uses ALM template. When you run the ALM-agent, the agent on the instance processes the ALM template and configures the instance as specified.


### Characteristics of ALM-agent {#characteristics-of-alm-agent}
The ALM-agent is a tool for managing container and continuious deployment for your application. It provides several key features:

- Container Management
  - ALM-agent can manage container lifecycle (create container, renew container image, delete old container...).
- Blue-Green Deployment using Container
  - ALM-agent uses Blue-Green Deployment to achieve zero-downtime deployment of new code.
- Health Checking
  - ALM-agent checks not only the instance status but also the container status.
- Multi Cloud
  - ALM-agent can run at any Cloud Service. Amazon Web Services, Alibaba Cloud, Fujitsu K5, and More!

