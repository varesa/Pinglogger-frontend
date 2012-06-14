<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
	<?php
	
	function getConfig($filename) {
	    if(!is_file($filename)) { print "Config file viewer.conf not present"; }
	    $config = parse_ini_file($filename);
	    
	    if(empty($config['path_to_logs'])) { print("Variable \"path_to_logs\" missing from config."); die; }
	    
	    return $config;
	}
	
	
	###############
	# Entry point #
	###############
	
	$config = getConfig("viewer.conf");
	?>
	
	</body>
</html>
