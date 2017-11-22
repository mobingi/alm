## alm-template structure

Below is a tree view of all possible components within an alm-template.

_The following structure is not a working demo template, but rather to explain all possible key names that may contain inside the template body._


<div class="file-tree">
    <ul>

        <li class="is-file">version<i>string</i></li>
        <li class="is-file">label<i>string</i></li>
        <li class="is-file">description<i>string</i></li>
        <li class="is-folder">vendor<i>object</i>
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
                <li class="is-folder">
                    provision<i>provision configuration</i>
                    <ul>
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
                                        <li class="is-folder">
                                            <i>object</i>
                                            <ul>
                                                <li class="is-file">CidrIp<i>string</i></li>
                                                <li class="is-file">FromPort<i>number</i></li>
                                                <li class="is-file">IpProtocol<i>string</i></li>
                                                <li class="is-file">ToPort<i>number</i></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="is-folder">
                                    egress<i>array of objects</i>
                                    <ul>
                                        <li class="is-folder">
                                            <i>object</i>
                                            <ul>
                                                <li class="is-file">CidrIp<i>string</i></li>
                                                <li class="is-file">FromPort<i>number</i></li>
                                                <li class="is-file">IpProtocol<i>string</i></li>
                                                <li class="is-file">ToPort<i>number</i></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="is-folder">
                            network_acl<i>array of objects</i>
                            <ul>
                                <li class="is-folder">
                                    <i>object</i>
                                    <ul>
                                        <li class="is-file">RuleNumber<i>number</i></li>
                                        <li class="is-file">Protocol<i>string</i></li>
                                        <li class="is-file">RuleAction<i>string</i></li>
                                        <li class="is-file">Egress<i>boolean</i></li>
                                        <li class="is-file">CidrBlock<i>string</i></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="is-folder">
                            load_balancer<i>object</i>
                            <ul>
                                <li class="is-folder">
                                    listeners<i>array of objects</i>
                                    <ul>
                                        <li class="is-folder">
                                            <i>object</i>
                                            <ul>
                                                <li class="is-file">LoadBalancerPort<i>string</i></li>
                                                <li class="is-file">InstancePort<i>string</i></li>
                                                <li class="is-file">Protocol<i>string</i></li>
                                                <li class="is-file">cert_domain<i>string</i></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="is-folder">
                                    health_check<i>object</i>
                                    <ul>
                                        <li class="is-file">HealthyThreshold<i>string</i></li>
                                        <li class="is-file">Interval<i>string</i></li>
                                        <li class="is-file">Target<i>string</i></li>
                                        <li class="is-file">Timeout<i>string</i></li>
                                        <li class="is-file">UnhealthyThreshold<i>string</i></li>
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

                <li class="is-folder">
                container<i>runtime configuration</i>
                <ul>
                    <li class="is-file">updated<i>number</i></li>
                    <li class="is-file">image<i>string</i></li>
                    <li class="is-file">codeDir<i>string</i></li>
                    <li class="is-file">gitRepo<i>string</i></li>
                    <li class="is-file">gitReference<i>string</i></li>
                    <li class="is-file">ports<i>array</i></li>
                    <li class="is-file">environmentVariables<i>array</i></li>
                </ul>
            </li>
            </ul>
        </li>
    </ul>
</div>
