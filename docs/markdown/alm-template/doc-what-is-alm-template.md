### Concepts {#concepts}

- ALM-template is a json formatted configuration file which defines your cloud-native application's architecture design and runtime configuration.

- ALM-template is cloud platform stateless. You write your template once and it works on any cloud platforms such as AWS, AliCloud, OpenStack, etc.

    _(We're still in the process of releasing more platform integrations, it might be the case that certain cloud platform support documented here but hasn't covered in the released open source code yet.)_

- You can save and reuse ALM-template at anytime.


### How does it work {#how-does-it-work}

- ALM-template is a component of [ALM](https://mobingi.com/how-mobingi-alm-works).
You write your ALM-template in code blocks and paste it on ALM console (or through CLI, API), it will be converted into each cloud platform's native configuration standards, then ALM will provision all resources on your behalf.

- If you specify the runtime configurations of your application in the `container` section of the ALM-template, then Mobingi ALM will also deploy an ALM-agent on each provisioned node to perform application runtime setup and continuous code deployment.

### Read more

- Learn more about [ALM-agent](https://learn.mobingi.com/alm-agent)

- See [example](https://learn.mobingi.com/alm-templates-example-templates) ALM-templates
