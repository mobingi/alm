<?php
include_once 'header.php';
?>


<!-- Main content -->
<article class="col-md-12 col-sm-12 main-content" role="main">

  <section>

    <div class="code-window">
      <div class="code-preview">

        <div class="row">
          <div class="col-md-12">
            <div class="promo">
              <h1>Welcome to Mobingi Learn Center</a></h1>
              <p>Mobingi is A Cloud-Native Application Lifecycle Management Platform</p>
            </div>
          </div>
        </div>

      </div>

    </div>



  </section>


    <section>
        <ul class="categorized-view view-col-3">
            <!--<li>
            <h5>Getting started</h5>
            <a href="#">Download and setup Mobingi ALM</a>
            <a href="#">How to log in to Mobingi ALM Console</a>
            <a href="#">Deploy your first cloud-native application</a>
            <a href="#">Manage the lifecycle of your applications</a>
            <a href="#">Monitoring, Logging and Scaling</a>
            </li>-->

            <li>
                <h5>Getting started</h5>
                <a href="<?php echo $siteUrl; ?>enterprise/get-started">First time login to console</a>
                <a href="<?php echo $siteUrl; ?>enterprise/get-started/add-aws-account">How to add your AWS account to ALM</a>
                <a href="<?php echo $siteUrl; ?>enterprise/get-started/add-alicloud-account">How to add your Alibaba Cloud account to ALM</a>
                <a href="<?php echo $siteUrl; ?>enterprise/get-started/add-k5-account">How to add your Fujitsu K5 account to ALM</a>
            </li>
            <li>
            <h5>ALM-template</h5>
                <a href="<?php echo $siteUrl; ?>what-is-alm-template">What is ALM-template</a>
                <!-- <a href="<?php echo $siteUrl; ?>alm-template-best-practices">Best practices</a> -->
                <a href="<?php echo $siteUrl; ?>working-with-alm-templates">Working with ALM-templates</a>
                <a href="<?php echo $siteUrl; ?>alm-templates-reference">ALM-template reference</a>
                <!-- <a href="<?php echo $siteUrl; ?>alm-templates-troubleshooting">Troubleshooting</a> -->
                <a href="<?php echo $siteUrl; ?>alm-template-language">ALM-template Language</a>
                <a href="<?php echo $siteUrl; ?>alm-templates-example-templates">Example ALM-templates</a>
            </li>

            <li>
                <h5>ALM-agent</h5>
                <a href="<?php echo $siteUrl; ?>alm-agent">Overview</a>
                <a href="<?php echo $siteUrl; ?>alm-agent/getting-started">Getting Started</a>
                <a href="<?php echo $siteUrl; ?>alm-agent/agent">Agent</a>
                <a href="<?php echo $siteUrl; ?>alm-agent/commands">Commands</a>
                <a href="<?php echo $siteUrl; ?>alm-agent/addons">Add-ons</a>
                <a href="<?php echo $siteUrl; ?>alm-agent/contributing">Contributing</a>
            </li>

            <li>
                <h5>Cli Reference</h5>
                <a href="<?php echo $siteUrl; ?>cli#overview">Overview</a>
                <a href="<?php echo $siteUrl; ?>cli#global-flags">Global flags</a>
                <a href="<?php echo $siteUrl; ?>cli#stack-list">Stack</a>
                <a href="<?php echo $siteUrl; ?>cli#template-versions">ALM-template</a>
                <a href="<?php echo $siteUrl; ?>cli#rbac-describe">RBAC</a>
                <a href="<?php echo $siteUrl; ?>cli#registry-list-catalog">Registry</a>
                <a href="<?php echo $siteUrl; ?>cli#version">Versions</a>
            </li>

            <li>
                <h5>API Reference</h5>
                <a href="<?php echo $siteUrl; ?>enterprise/api#end-point">API Endpoint</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#versioning">API Versioning</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#authentication">Authentication</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#alm-templates">Alm Template</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#stacks">Stacks</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#rbac">RBAC</a>
                <a href="<?php echo $siteUrl; ?>enterprise/api#alm-agent">Alm-Agent</a>
            </li>

            <li>
                <h5>RBAC</h5>
                <a href="<?php echo $siteUrl; ?>enterprise/what-is-rbac">What is Role Based Access Control</a>
                <a href="<?php echo $siteUrl; ?>enterprise/rbac-getting-started">Getting Started</a>
                <a href="<?php echo $siteUrl; ?>enterprise/working-with-rbac">Working with RBAC</a>
                <a href="<?php echo $siteUrl; ?>enterprise/rbac-reference">RBAC Reference</a>
                <a href="<?php echo $siteUrl; ?>enterprise/rbac-release-history">Release History</a>
                <a href="<?php echo $siteUrl; ?>enterprise/rbac-example-roles">Example RBAC Roles</a>
            </li>


        </ul>
    </section>

</article>
<!-- END Main content -->



<?php include_once 'footer-home.php'; ?>
