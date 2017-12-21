## Alm-template Formats {#template-formats}

Alm-template is designed in __Json__ format. You can also write your template in Yaml format and then convert it into json file when you deploy your stacks on ALM UI (or through CLI, API).

_Official yaml format support is in-progress_

## Alm-template Components {#template-components}

Alm-template top-level components consist of `version`, `label`, `description`, `vendor`, `configurations`.

### - version {#template-components-version}

The version of Alm-template release.

This value is always _2017-03-03_.

### - label {#template-components-label}

The label of the Alm-template.

You can use this section to mark the labels for each of your alm-template versions. This is useful when you update your template.

This value can be empty, and you can write up to 64 characters in length.

### - description {#template-components-description}

The description of the Alm-template.

You can use this section to describe the purpose of the alm-template, _for example: production app stack_.

This value can be empty, and you can write up to 255 characters in length.

### - vendor {#template-components-vendor}

The cloud platform vendor of which the template will be deployed to.

You need to specify the vendor in every alm-template you write, and can only specify one vendor at a time.

### - configurations {#template-components-configurations}

The configurations of the stack which Alm-template about to deploy.

In the configurations section, you specify one or multiple configuration layers of your application's provision and container runtime settings.

Inside each layer, there are four sections you need to specify:

#####{#template-components-configurations-role}
- __role__

    The "role" of which the stack layer defines to.

    You deploy multiple layers within one Alm-template, for example two _web_ layers, one _bastion_ layer and one _database_ layer. The current available role names:

    - `web`
    - `bastion`

#####{#template-components-configurations-flag}
- __flag__

    The unique identifier of each layer.

    You must specify the _flag_ name for each configuration layer. The value must between 4 to 18 characters in length and contains only alphanumeric characters.

#####{#template-components-configurations-provision}
- __provision__

    The infrastructure provisioning configurations.

    For more information on _provision_ section, please refer to [ALM Template Reference guide](https://learn.mobingi.com/alm-templates-reference#provision).

#####{#template-components-configurations-container}
- __container__

    The software runtime configurations _(defined as docker images)_ and code deployment requirement for each instance node.

    For more information on _container_ section, please refer to [ALM Template Reference guide](https://learn.mobingi.com/alm-templates-reference#container).


## Alm-template Structure {#template-structure}

Below is a tree view of all possible components within an alm-template.

<div class="alert alert-warning">The following structure is not a working demo template, but rather to explain all possible key names that may contain in the template body.</div>

For Alm-template examples, please refer to [Example ALM Templates](https://learn.mobingi.com/alm-templates-example-templates).

<div class="file-tree">
    <ul>
        <li class="is-file">version<i>string</i></li>
        <li class="is-file">label<i>string</i></li>
        <li class="is-file">description<i>string</i></li>
        <li class="is-folder open">vendor<i>object</i>
            <ul>
                <li class="is-folder">
                    aws<i>object</i>
                    <ul>
                        <li class="is-file">cred<i>string</i></li>
                        <li class="is-file">secret<i>string</i></li>
                        <li class="is-file">region<i>string</i></li>
                    </ul>
                </li>
                <li class="is-folder">
                    alicloud<i>object</i>
                    <ul>
                        <li class="is-file">cred<i>string</i></li>
                        <li class="is-file">secret<i>string</i></li>
                        <li class="is-file">region<i>string</i></li>
                    </ul>
                </li>
                <li class="is-folder">
                    k5<i>object</i>
                    <ul>
                        <li class="is-file">cred<i>string</i></li>
                        <li class="is-file">region<i>string</i></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="is-folder open">configurations<i>array of objects</i>
            <ul>
                <li class="is-file open">
                    role<i>role name</i>
                </li>
                <li class="is-file open">
                    flag<i>flag name</i>
                </li>
                <li class="is-folder open">
                    provision<i>provision configuration</i>
                    <ul>
                        <li class="is-file">vpc_id<i>string</i></li>
                        <li class="is-file">availability_zone<i>string</i></li>
                        <li class="is-file">instance_type<i>string</i></li>
                        <li class="is-file">image<i>string</i></li>
                        <li class="is-file">instance_count<i>number</i></li>
                        <li class="is-file">volume_type<i>string</i></li>
                        <li class="is-file">volume_size<i>number</i></li>
                        <li class="is-file">keypair<i>boolean</i></li>
                        <li class="is-folder">
                            subnet<i>object</i>
                            <ul>
                                <li class="is-file">cidr<i>string</i></li>
                                <li class="is-file">public<i>boolean</i></li>
                                <li class="is-file">auto_assign_public_ip<i>boolean</i></li>
                            </ul>
                        </li>
                        <li class="is-folder">
                            security_group<i>object</i>
                            <ul>
                                <li class="is-folder">
                                    ingress<i>array of objects</i>
                                    <ul>
                                        <li class="is-file">cidr_ip<i>string</i></li>
                                        <li class="is-file">from_port<i>number</i></li>
                                        <li class="is-file">ip_protocol<i>string</i></li>
                                        <li class="is-file">to_port<i>number</i></li>
                                    </ul>
                                </li>
                                <li class="is-folder">
                                    egress<i>array of objects</i>
                                    <ul>
                                        <li class="is-file">cidr_ip<i>string</i></li>
                                        <li class="is-file">from_port<i>number</i></li>
                                        <li class="is-file">ip_protocol<i>string</i></li>
                                        <li class="is-file">to_port<i>number</i></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="is-folder">
                            network_acl<i>array of objects</i>
                            <ul>
                                <li class="is-file">rule_number<i>number</i></li>
                                <li class="is-file">protocol<i>string</i></li>
                                <li class="is-file">rule_action<i>string</i></li>
                                <li class="is-file">acl_egress<i>boolean</i></li>
                                <li class="is-file">cidr<i>string</i></li>
                            </ul>
                        </li>
                        <li class="is-folder">
                            load_balancer<i>object</i>
                            <ul>
                                <li class="is-file">lb_type<i>string</i></li>
                                <li class="is-file">scheme<i>string</i></li>
                                <li class="is-file">subnets<i>string</i></li>
                                <li class="is-file">security_groups<i>string</i></li>
                                <li class="is-folder">
                                    listeners<i>array of objects</i>
                                    <ul>
                                        <li class="is-file">load_balancer_port<i>string</i></li>
                                        <li class="is-file">protocol<i>string</i></li>
                                        <li class="is-file">instance_port<i>string</i></li>
                                        <li class="is-file">instance_protocol<i>string</i></li>
                                        <li class="is-file">cert_domain<i>string</i></li>
                                    </ul>
                                </li>
                                <li class="is-folder">
                                    health_check<i>object</i>
                                    <ul>
                                        <li class="is-file">healthy_threshold<i>string</i></li>
                                        <li class="is-file">interval<i>string</i></li>
                                        <li class="is-file">target<i>string</i></li>
                                        <li class="is-file">timeout<i>string</i></li>
                                        <li class="is-file">unhealthy_threshold<i>string</i></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="is-folder">
                            auto_scaling<i>object</i>
                            <ul>
                                <li class="is-file">min<i>number</i></li>
                                <li class="is-file">max<i>number</i></li>
                                <li class="is-file">spot_min<i>number</i></li>
                                <li class="is-file">spot_max<i>number</i></li>
                                <li class="is-file">cooldown<i>string</i></li>
                                <li class="is-file">healthcheck_grace_period<i>string</i></li>
                                <li class="is-file">availability_zones<i>string</i></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="is-folder open">
                    container<i>runtime configuration</i>
                    <ul>
                        <li class="is-file">container_image<i>string</i></li>
                        <li class="is-file">container_registry_username<i>string</i></li>
                        <li class="is-file">container_registry_password<i>string</i></li>
                        <li class="is-file">container_code_dir<i>string</i></li>
                        <li class="is-file">container_git_repo<i>string</i></li>
                        <li class="is-file">container_git_reference<i>string</i></li>
                        <li class="is-file">container_git_private_key<i>string</i></li>
                        <li class="is-file">container_ports<i>array of numbers</i></li>
                        <li class="is-file">container_users<i>object</i></li>
                        <li class="is-file">container_env_vars<i>object</i></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
