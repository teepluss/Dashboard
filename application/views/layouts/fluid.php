<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="<?php echo config_item('charset'); ?>">
    	<title><?php echo $title; ?></title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
		<link href="<?php echo CIUri::assets('plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" />
		<link href="<?php echo CIUri::assets('plugins/bootstrap/css/bootstrap-responsive.css'); ?>" rel="stylesheet" />
		<style type="text/css">
			body { padding-top: 60px; padding-bottom: 40px; }
      		.sidebar-nav { padding: 9px 0; }
    	</style>
		<?php echo $_styles; ?>
	</head>
	<body>		
		<!-- header -->
		<?php echo $header; ?>
		<div class="container-fluid">
			
			<?php echo $content; ?>
			<hr>		
			<!-- Footer -->
			<?php echo $footer; ?>
		
		</div><!--/.fluid-container-->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="<?php echo CIUri::assets('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<?php echo $_scripts; ?>
	</body>
</html>