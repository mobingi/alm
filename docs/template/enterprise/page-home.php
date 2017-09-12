<?php
include_once __DIR__.'/../header.php';
?>


<!-- Main content -->
<article class="col-md-12 col-sm-12 main-content" role="main">

  <section>

    <div class="code-window">
      <div class="code-preview">

        <div class="row">
            <div class="col-md-4">
              <div class="promo">
                <a href="<?php echo $siteUrl; ?>enterprise/rbac"><i class="fa fa-eye-slash top-page"></i></a>
                <h4>RBAC Documentation</a></h4>
                <p>
                  Role Based Access Control (RBAC) feature is to help you centralize activities and assign role based access control to all members in your organization.<br />
                </p>
              </div>
            </div>
            <div class="col-md-4">
                <div class="promo">
                  <a href="<?php echo $siteUrl; ?>enterprise/cli"><i class="fa fa-terminal top-page"></i></a>
                  <h4>Mobingi-CLI Documentation</a></h4>
                  <p>
                    Using the Mobingi command line to interact with Mobingi ALM services. <br />
                  </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="promo">
                  <a href="<?php echo $siteUrl; ?>enterprise/api"><i class="fa fa-code top-page"></i></a>
                  <h4>Mobingi API Reference</a></h4>
                  <p>
                    API Reference on helping you to build your applications against our RESTful API service.<br />
                  </p>
                </div>
            </div>
        </div>

      </div>

    </div>

  </section>


  <section class="col-md-12 col-sm-12 main-content" role="main">

      <ul class="categorized-view view-col-3">

          <li>
            <h5>RBAC Documentation</h5>
            <a href="<?php echo $siteUrl; ?>enterprise/what-is-rbac">What is Role Based Access Control</a>
            <a href="<?php echo $siteUrl; ?>enterprise/rbac-getting-started">Getting Started</a>
            <a href="<?php echo $siteUrl; ?>enterprise/working-with-rbac">Working with RBAC</a>
            <a href="<?php echo $siteUrl; ?>enterprise/rbac-reference">RBAC Reference</a>
            <a href="<?php echo $siteUrl; ?>enterprise/rbac-release-history">Release History</a>
            <a href="<?php echo $siteUrl; ?>enterprise/rbac-example-roles">Example RBAC Roles</a>
          </li>

          <li>
            <h5>Cli Documentation</h5>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#overview">Overview</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#global-flags">Global flags</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#stack-list">Stacks</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#template-versions">Template</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#rbac-describe">RBAC</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#creds-view">Credentials</a>
            <a href="<?php echo $siteUrl; ?>enterprise/cli#registry-list-catalog">Registry</a>
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

        </ul>

</section>



</article>
<!-- END Main content -->



<?php include_once __DIR__.'/../footer.php'; ?>
