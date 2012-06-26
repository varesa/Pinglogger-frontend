<!DOCTYPE html>
<html>
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
	    $filename = $_GET['file'];
	    $file = rtrim($config['path_to_logs'],"/") . "/" . $filename;
	} else {
	    exit("Please use with the GET parameter 'file', which points to the logfile to be viewed");
	}
	
	if(!is_file($file)) {
	    exit("The logfile $file does not exist");
	}

	?>

	<head>
	    <title><?php print("Log: $filename ($file)"); ?></title>
	</head>
	<body>
	
	    <div id="loading">Please wait while the log is rendered</div>
	    <?php 
	        flush();
		ob_flush();
	        #exec("render_script");
		sleep(2);
	    ?>
	
	    <script type="text/javascript">
		document.getElementById("loading").style.display = 'none';
	    </script>
	
	</body>
</html>
