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
	
	function getFiles($config) {
	    if(!is_dir($config['path_to_logs'])) { 
		print("Can't access logs-dir: " . $config['path_to_logs']); die; 
	    }
	    $handle = opendir($config['path_to_logs']);
	    
	    $files = Array();
	    
	    while(false !== ($file = readdir($handle))) {
		if($file != '.' && $file != '..') {
		    $files[] = $file;
		}
	    }
	    return $files;
	}
	
	###############
	# Entry point #
	###############
	
	$config = getConfig("viewer.conf");
	?>
	
	<table>
	<th colspan=2>Please select a logfile to be viewed:</th>
	
	    <?php
	    foreach(getFiles($config) as $file) {
		print("<tr><td>" . $file . "&nbsp;&nbsp;</td><td><a href='view.php?file=" . $file . "'>View</a></td></tr>");
	    }
		
	    ?>
	</table>

	</body>
</html>
