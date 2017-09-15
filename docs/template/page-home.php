<?php
include_once 'header.php';
?>


<!-- Main content -->
<article class="col-md-12 col-sm-12 main-content" role="main">

  <section>

    <div class="code-window">
      <div class="code-preview">

        <div class="row">
          <div class="col-md-4">
            <div class="promo">
              <a href="">
                <i class="fa fa-star-half-o top-page"></i>
              </a>
              <h3>Get Started</h3>
              <p>A getting started guide to help you understand what Mobingi provides.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="promo">
              <a href="">
                <i class="fa fa-book top-page"></i>
              </a>
              <h3>Documentation</h3>
              <p>Full documentation including guide, tutorials, examples, faqs and more.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="promo">
              <a href="<?php echo $siteUrl; ?>enterprise"><i class="fa fa-star top-page"></i></a>
              <h3>Enterprise Edition</a></h3>
              <p>
                API Reference on building your applications against our RESTful API service.<br />
              </p>
            </div>
          </div>
        </div>



      </div>

    </div>



  </section>


    <section>
      <ul class="categorized-view view-col-3">
        <li>
          <h5>Getting started</h5>
          <a href="#">Download and setup Mobingi ALM</a>
          <a href="#">How to log in to Mobingi ALM Console</a>
          <a href="#">Deploy your first cloud-native application</a>
          <a href="#">Manage the lifecycle of your applications</a>
          <a href="#">Monitoring, Logging and Scaling</a>
        </li>

        <li>
          <h5>Mobingi ALM-template</h5>
          <a href="<?php echo $siteUrl; ?>what-is-alm-template">What is ALM-template</a>
          <a href="<?php echo $siteUrl; ?>alm-template-best-practices">Best practices</a>
          <a href="<?php echo $siteUrl; ?>working-with-alm-templates">Working with ALM-templates</a>
          <a href="<?php echo $siteUrl; ?>alm-templates-reference">ALM-template reference</a>
          <a href="<?php echo $siteUrl; ?>alm-templates-troubleshooting">Troubleshooting</a>
          <a href="<?php echo $siteUrl; ?>alm-templates-release-history">Release History</a>
          <a href="<?php echo $siteUrl; ?>alm-templates-example-templates">Example ALM-templates</a>
        </li>

        <li>
          <h5>Mobingi ALM-agent</h5>
          <a href="<?php echo $siteUrl; ?>alm-agent">Overview</a>
          <a href="<?php echo $siteUrl; ?>alm-agent/getting-started">Getting Started</a>
          <a href="<?php echo $siteUrl; ?>alm-agent/commands">Commands</a>
          <a href="<?php echo $siteUrl; ?>alm-agent/agent">Agent</a>
          <a href="<?php echo $siteUrl; ?>alm-agent/addons">Add-ons</a>
          <a href="<?php echo $siteUrl; ?>alm-agent/contributing">Contributing</a>
        </li>

        <li>
          <h5>Mobingi API Reference</h5>
          <a href="#">Overview</a>
          <a href="#">ALM-template</a>
          <a href="#">Stacks</a>
          <a href="#">RBAC</a>
          <a href="#">ALM-agent</a>
        </li>

        <li>
          <h5>Enterprise Edition</h5>
          <a href="#">Advanced Features</a>
          <a href="<?php echo $siteUrl; ?>enterprise/rbac">Role based access control documentation</a>
          <a href="<?php echo $siteUrl; ?>enterprise/cli">Mobingi-cli documentation (Enterprise Edition)</a>
          <a href="<?php echo $siteUrl; ?>enterprise/api">Mobingi API reference (Enterprise Edition)</a>
        </li>
      </ul>
    </section>

</article>
<!-- END Main content -->



<?php include_once 'footer.php'; ?>
