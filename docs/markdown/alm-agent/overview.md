### What is Alm-agent? {#what-is-alm-agent}
The Alm-agent is software for Mobingi ALM. Alm-agent is the primary component of container management.

Alm-agent runs on instances, manages Docker container and deploys code to instance on behalf of you.

Alm-agent uses ALM template. When you run the Alm-agent, the agent on the instance processes the ALM template and configures the instance as specified.


### Characteristics of Alm-agent {#characteristics-of-alm-agent}
The Alm-agent is a tool for managing container and continuious deployment for your application. It provides several key features:

- Container Management
  - Alm-agent can manage container lifecycle (create container, renew container image, delete old container...).
- Blue-Green Deployment using Container
  - Alm-agent uses Blue-Green Deployment to achieve zero-downtime deployment of new code.
- Health Checking
  - Alm-agent checks not only the instance status but also the container status.
- Multi Cloud
  - Alm-agent can run at any Cloud Service. Amazon Web Services, Alibaba Cloud, Fujitsu K5, and More!

