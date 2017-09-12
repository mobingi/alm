<?php
include_once __DIR__.'/../header.php';

require __DIR__.'/../Parsedown.php';
require __DIR__.'/../ParsedownExtra.php';
require __DIR__.'/../ParsedownExtraPlugin.php';

// $Parsedown = new Parsedown();
$parser = new ParsedownExtraPlugin();

$content = file_get_contents(realpath(__DIR__ . '/../..').'/markdown/alm-agent/overview.md');


?>


<!-- Sidebar -->

    <!-- Sidebar -->
    <aside class="col-sm-3 sidebar">
        <?php include_once realpath(__DIR__ . '/../..').'/markdown/alm-agent/sidebar.md.php'; ?>
    </aside>
    <!-- END Sidebar -->

<!-- END Sidebar -->


<!-- Main content -->
<article class="col-sm-9 main-content" role="main">
    <header>
        <h1>Overview - Mobingi ALM agent</h1>
    </header>
    <div class="alert alert-success">
        Mobingi ALM agent is an open source software, you can find the source code at <i><a href="https://github.com/mobingi/alm-agent">https://github.com/mobingi/alm-agent</a></i>
    </div>

    <?php echo $parser->text($content); ?>

</article>


<?php include_once __DIR__.'/../footer.php'; ?>
<script type="text/javascript">
$("table").addClass("table table-bordered table-striped");
$("a[href='<?php echo $siteUrl; ?>alm-agent']").parent('li').addClass("active");
</script>
