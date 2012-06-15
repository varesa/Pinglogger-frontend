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
	
	
	if(isset($_GET['file']) && $_GET['file'] != "") {
	    $file = rtrim($config['path_to_logs'],"/") . "/" . $_GET['file'];
	} else {
	    exit("Please use with the GET parameter 'file', which points to the logfile to be viewed");
	}
	
	if(!is_file($file)) {
	    exit("The logfile $file does not exist");
	}

	?>
	
	</body>
</html>
