<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="Tru Naluten <?=isset($page['keyword'])?$page['keyword']:''?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$page['title']?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<script type="text/javascript" src="lib/scr.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>
		<div id="main">
			<div id="leftside" class="scrollable">
	
<?php require ("$tmpl/side-div.php"); ?>
			</div> <!-- Side -->
			<div id="container" class="scrollable">
				<div id="head">
					<div class="clearbox">

						<div class="section">
							<h2 id="home">[ <?=nnk('','99k')?> | <?=alter('', 'altervista')?> ]</h2>
							<h1 id="title"><?=$page['title']?></h1>
							<h2 id="subtitle"><?=$page['subtitle']?></h2>
						</div>

					</div> <!-- Clear Box -->
				</div> <!-- Head -->

				<div id="content">
					<div class="clearbox">

						<div class="section">
<?php if (isset($related['prev'])) { ?>
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?=ilink ($related['prev'])?>
							</p></div><div class="section">
<? }

	mkpage($d, null, $context);

	if (isset($related['next'])) { ?>
							</div><div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?=ilink ($related['next'])?>
							</p>
<?php } ?>
						
						</div> <!-- Section -->
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div id="foot">
					<div class="clearbox">
						<div class="section">

<?php require_once ($tmpl . '/footer-div.php') ?>
						</div>
					</div> <!-- Clear Box -->
				</div> <!-- Foot -->
			</div>	
			<div id="rightside" class="scrollable">
				<div class="clearbox">
					<div class="section">

<?php require_once ($tmpl .'/related.php'); ?>
<?php require_once ($sides .'/'. $page['side']); ?>
					</div> <!-- Section -->	
				</div> <!-- ClearBox -->
			</div> <!-- RightSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
