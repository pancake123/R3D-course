<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="css/webgl.css">
	<title>~WebGL~</title>
</head>
<body class="row">
<div class="col-xs-12 clear">
	<div class="col-xs-8 clear" id="scene"></div>
	<div class="col-xs-4 clear text-center">
		<h3>Перспектива: <b><span id="perspective">45</span>&deg;</b></h3>
		<div class="btn-group">
			<button class="btn btn-primary glyphicon glyphicon-minus" onclick="changePerspective(fov - 10)"></button>
			<button class="btn btn-primary glyphicon glyphicon-plus" onclick="changePerspective(fov + 10)"></button>
		</div>
	</div>
</div>
</body>
<script type="text/javascript" src="js/jquery-2.1.3.js"></script>
<script type="text/javascript" src="js/three.js"></script>
<script type="text/javascript" src="js/webgl.js"></script>
</html>