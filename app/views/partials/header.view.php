<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ------------------------------------------------- -->
		<script src="assets/lib/jquery-3.7.0.min.js"></script>

	    <script src="assets/lib/data table/dataTables.js"></script>
		<script src="assets/lib/data table/dataTables.buttons.min.js"></script>
		<script src="assets/lib/data table/jszip.min.js"></script>
		<script src="assets/lib/data table/pdfmake.min.js"></script>
		<script src="assets/lib/data table/pdfmake_fonts.js"></script>
		<script src="assets/lib/data table/buttons.html5.min.js"></script>
		<script src="assets/lib/data table/buttons.print.min.js"></script>

	<!-- ------------------------------------------------- -->
	<script src="assets/js/script.js"></script>
	<!-- ------------------------------------------------- -->

	<title><?= esc(APP_NAME) ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>
<body>
	<?php

		$no_nav = ["login"];

		// Check if $controller is set and not empty before using it
		if (isset($controller) && !in_array($controller, $no_nav)):

	?>
		<?php require_once views_path('partials/nav');?>
	<?php endif;?>

	<div class="container-fluid" style="min-width: 350px">
