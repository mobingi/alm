<!-- Sidebar is not parsed thru script to give you more control over style-->

<ul class="nav sidenav dropable sticky">

    <li>
        <a href="<?php echo $siteUrl; ?>what-is-alm-template">What is ALM Template</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>what-is-alm-template#concepts">ALM Template Concepts</a></li>
            <li><a href="<?php echo $siteUrl; ?>what-is-alm-template#how-does-it-work">How does ALM Template Work?</a></li>
        </ul>
    </li>
    <!-- <li>
        <a href="<?php echo $siteUrl; ?>alm-template-best-practices">Best Practices</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>alm-template-best-practices#">sub_item</a></li>
        </ul>
    </li> -->
    <li>
        <a href="<?php echo $siteUrl; ?>working-with-alm-templates">Working with ALM Templates</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-formats">Template Formats</a></li>
            <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components">Template Components</a></li>
            <ul>
                <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-version">- version</a></li>
                <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-label">- label</a></li>
                <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-description">- description</a></li>
                <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-vendor">- vendor</a></li>
                <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-configurations">- configurations</a>
                    <ul>
                        <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-configurations-role">- role</a></li>
                        <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-configurations-flag">- flag</a></li>
                        <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-configurations-provision">- provision</a></li>
                        <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-components-configurations-container">- container</a></li>
                    </ul>
                </li>

            </ul>
            <li><a href="<?php echo $siteUrl; ?>working-with-alm-templates#template-structure">ALM Template Structure</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $siteUrl; ?>alm-templates-reference">ALM Template Reference</a>
        <ul>
            <li>
                <a href="<?php echo $siteUrl; ?>alm-templates-reference#provision">- provision</a>
                <ul>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#vpc_id">- vpc_id</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#availability_zone">- availability_zone</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#instance_type">- instance_type</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#image">- image</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#instance_count">- instance_count</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#volume_type">- volume_type</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#volume_size">- volume_size</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#keypair">- keypair</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#subnet">- subnet</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#network_acl">- network_acl</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#security_group">- security_group</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#auto_scaling">- auto_scaling</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#load_balancer">- load_balancer</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo $siteUrl; ?>alm-templates-reference#container">- container</a>
                <ul>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_image">- container_image</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_registry_username">- container_registry_username</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_registry_password">- container_registry_password</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_code_dir">- container_code_dir</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_git_repo">- container_git_repo</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_git_reference">- container_git_reference</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_git_private_key">- container_git_private_key</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_ports">- container_ports</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_users">- container_users</a></li>
                    <li><a href="<?php echo $siteUrl; ?>alm-templates-reference#container_env_vars">- container_env_vars</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- <li>
        <a href="<?php echo $siteUrl; ?>alm-templates-troubleshooting">Troubleshooting</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-troubleshooting#">sub_item</a></li>
        </ul>
    </li> -->
    <!-- <li>
        <a href="<?php echo $siteUrl; ?>alm-templates-release-history">Release History</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-release-history#current-version">Current version</a></li>
        </ul>
    </li> -->
    <li>
        <a href="<?php echo $siteUrl; ?>alm-templates-example-templates">Example ALM Templates</a>
        <ul>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#single-server">Single server</a></li>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#single-server-with-hello-world">Single server with "Hello World"</a></li>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#single-server-with-custom-subnet">Single server with custom Subnet</a></li>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#single-server-with-custom-network-acl">Single server with custom Network ACL</a></li>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#single-server-with-custom-security-group">Single server with custom Security Group</a></li>
            <li><a href="<?php echo $siteUrl; ?>alm-templates-example-templates#load-balanced">Load-balanced server stack</a></li>
        </ul>
    </li>

</ul>
