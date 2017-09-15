<?php
if(!in_array($_SERVER['REMOTE_ADDR'], array(
    '127.0.0.1',
    '::1'
))){
	// on server
	$domain = '//' . "{$_SERVER['HTTP_HOST']}" .'/template/';
	$siteUrl = '//' . "{$_SERVER['HTTP_HOST']}" . '/';
}else{
	// on localhost development
    $scriptname = explode('/', $_SERVER['SCRIPT_NAME']);
	$domain = "//" . $_SERVER["HTTP_HOST"] . "/template/";
	$siteUrl = "//" . $_SERVER["HTTP_HOST"] . "/";
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<title><?php echo $title; ?> - Mobingi Documentation</title>

		<!-- Styles -->
		<link href="<?php echo $domain; ?>assets/css/theDocs.all.min.css" rel="stylesheet">
		<link href="<?php echo $domain; ?>assets/css/custom.css?v11" rel="stylesheet">
		<link href="<?php echo $domain; ?>assets/css/skin-blue.css?v1" rel="stylesheet">

		<!-- Fonts -->
		<!-- <link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500%7CLato:300,400' rel='stylesheet' type='text/css'> -->

		<!-- Favicons -->
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
		<link rel="icon" href="<?php echo $domain; ?>assets/img/favicon.ico?v1">
        <style>
        pre[class*="language-"] {
            padding-top: 8px;
        }

        @font-face {font-family: "Proxima Nova W01 Regular";
          src: url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.eot"); /* IE9*/
          src: url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
          url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.woff2") format("woff2"), /* chrome、firefox */
          url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.woff") format("woff"), /* chrome、firefox */
          url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.ttf") format("truetype"), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
          url("<?php echo $domain; ?>assets/fonts/4a4fee972680df7928438c04f33e9cca.svg#Proxima Nova W01 Regular") format("svg"); /* iOS 4.1- */
        }

        body {
            color: rgb(51, 65, 82);
        	font-family:"Proxima Nova W01 Regular", -apple-system, system-ui, Roboto, "Helvetica Neue", Arial, sans-serif !important;
            /*font-size:16px;*/
        	font-style:normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        	/*font-weight: 600;*/
            /*line-height: 1.1;*/
            overflow-x: hidden;
        }

        </style>
	</head>

	<body data-spy="scroll" data-target=".sidebar" data-offset="200">

		<header class="site-header navbar-transparent">

		<!-- Top navbar & branding -->
		<nav class="navbar navbar-default" style="padding-top:2px;">
			<div class="container">

				<!-- Toggle buttons and brand -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
						<span class="glyphicon glyphicon-option-vertical"></span>
					</button>

					<button type="button" class="navbar-toggle for-sidebar" data-toggle="offcanvas">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="<?php echo $siteUrl; ?>" style="font-size:inherit;font-weight:bold"><img src="<?php echo $domain; ?>assets/img/Mobingi_logo_horizontal_invert.png" style="max-height:40px;">| &nbsp; Learn Center</a>
				</div>
				<!-- END Toggle buttons and brand -->

				<!-- Top navbar -->
				<div id="navbar" class="navbar-collapse collapse" aria-expanded="true" role="banner">
					<ul class="nav navbar-nav navbar-left" id="entdoc" style="display:none;">
                        <li><a href="<?php $siteUrl; ?>/enterprise"><button type="button" class="btn btn-xs btn-dark">Enterprise Version</button></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://mobingi.com" target="_blank">visit mobingi.com</a></li>
					</ul>
				</div>
				<!-- END Top navbar -->

			</div>
		</nav>
		<!-- END Top navbar & branding -->

		<!-- Banner -->
		<div class="banner auto-size" style="background-color: #0062DF;padding-top:0px">
			<!-- <div class="container text-white">
				<h1>RESTful <strong>API</strong> Reference</h1>
			</div> -->
		</div>
		<!-- END Banner -->

	</header>

	  <main class="container">
        <div class="row">
