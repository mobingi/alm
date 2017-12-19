<?php
include_once __DIR__.'/../header.php';

require __DIR__.'/../Parsedown.php';
require __DIR__.'/../ParsedownExtra.php';
require __DIR__.'/../ParsedownExtraPlugin.php';

// $Parsedown = new Parsedown();
$parser = new ParsedownExtraPlugin();

$content = file_get_contents(realpath(__DIR__ . '/../..').'/markdown/enterprise/doc-api.md');


?>


<!-- Sidebar -->

    <!-- Sidebar -->
    <aside class="col-sm-3 sidebar">
        <?php include_once realpath(__DIR__ . '/../..').'/markdown/enterprise/doc-api-sidebar.md.php'; ?>
    </aside>
    <!-- END Sidebar -->

<!-- END Sidebar -->


<!-- Main content -->
<article class="col-sm-9 main-content" role="main">
<!--    <div class="alert alert-info">-->
<!--        <i>You're viewing Mobingi Enterprise Edition API Reference site, click <b><a href="--><?php //echo $siteUrl; ?><!--api/v3">here</a></b> to visit Community Edition API Reference.</i>-->
<!--    </div>-->
    <header>
        <h1 id="api-reference">API Reference (Enterprise Edition)</h1>
    </header>
    <div class="alert alert-success">
        Mobingi API is organized around REST. <br />
        Our API has predictable, resource-oriented URLs. We support CORS (Cross-Origin Resource Sharing), allowing you to interact securely with our API.
    </div>

    <?php echo $parser->text($content); ?>

</article>


<?php include_once __DIR__.'/../footer.php'; ?>
<script type="text/javascript">
$("table").addClass("table table-bordered table-striped");
</script>
