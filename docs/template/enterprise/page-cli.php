<?php
include_once __DIR__.'/../header.php';

require __DIR__.'/../Parsedown.php';
require __DIR__.'/../ParsedownExtra.php';
require __DIR__.'/../ParsedownExtraPlugin.php';

// $Parsedown = new Parsedown();
$parser = new ParsedownExtraPlugin();

$content = file_get_contents(realpath(__DIR__ . '/../..').'/markdown/enterprise/doc-cli.md');


?>


<!-- Sidebar -->

    <!-- Sidebar -->
    <aside class="col-sm-3 sidebar">
        <?php include_once realpath(__DIR__ . '/../..').'/markdown/enterprise/doc-cli-sidebar.md.php'; ?>
    </aside>
    <!-- END Sidebar -->

<!-- END Sidebar -->


<!-- Main content -->
<article class="col-sm-12 main-content" role="main">
    <div class="alert alert-info">
        <i>You're viewing Enterprise Edition Mobingi-cli Document site.</i>
    </div>
    <header>
        <h1 id="api-reference">Mobingi-Cli Documentation</h1>
    </header>
    <div class="alert alert-success">
        mobingi-cli is an open source software, you can find the source code at <i><a href="https://github.com/mobingi/mobingi-cli">https://github.com/mobingi/mobingi-cli</a></i>
    </div>

    <?php echo $parser->text($content); ?>

</article>


<?php include_once __DIR__.'/../footer.php'; ?>
<script type="text/javascript">
$("table").addClass("table table-bordered table-striped");
</script>
