<?php require_once"config/init.php ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dropzone</title>
	<link rel="stylesheet" type="text/css" href="asset/min/basic.min.css">
	<link rel="stylesheet" href="asset/min/dropzone.min.css">
	
</head>
<body>
	<div class="container">
		<form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>
	</div>
	<style>
		body {
			background-color; #E5E5E5;
		}
		.container{
			max-width; 757px;
			margin: 400px auto 0;
		}
		.dropzone{
			font-size; 18px;
			font-family: monospace;
			border-radius: 10px;
			border: 2px dashed #E566B6F
		}
	</style>
<script src="asset/min/dropzone.min.js">
</script>
</body>
</html>
