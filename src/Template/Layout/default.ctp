<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?= $this->fetch('title') ?></title>

	<?php
	echo $this->Html->script('/assets/dashboard');
	echo $this->Html->css('/assets/dashboard');
	?>

	<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="icon" href="/favicon.ico">

</head>
<body>
	<div id="container">
		<?= $this->fetch('content') ?>
	</div>
</body>
</html>
