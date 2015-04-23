<?php
/**
 * @var string $content
 * @var string $url
 */
?>

<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?= $url ?>css/index.css">
	<link rel="stylesheet" type="text/css" href="<?= $url ?>css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= $url ?>css/bootstrap-theme.css">
	<script type="text/javascript" src="<?= $url ?>js/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="<?= $url ?>js/bootstrap.js"></script>
	<title>~bd~</title>
</head>
<body>
<div class="alert-container">
<?php foreach (Session::getInstance()->get("alerts", [], true) as $alert): ?>
	<div class="alert alert-<?= $alert["type"] ?> alert-dismissible fade in" role="alert">
		<span><?= $alert["message"] ?></span>
	</div>
<?php endforeach; ?>
</div>
<div class="col-xs-12">
	<div class="col-xs-4 col-xs-offset-4 body-content">
		<?= $content ?>
	</div>
	<div class="col-xs-8" ></div>
</div>
</body>
</html>