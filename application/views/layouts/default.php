<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo config_item('charset'); ?>" />
		<?php echo $_scripts; ?>		
		<?php echo $_styles; ?>
	</head>
	<body>
		<header><?php echo $header; ?></header>
		<div id="container">
			<?php echo $content; ?>
		</div>
		<footer><?php echo $footer; ?></footer>
	</body>
</html>