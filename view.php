<!DOCTYPE html>
<html>
	<?php
	
	function getConfig($filename) {
	    if(!is_file($filename)) { print "Config file viewer.conf not present"; }
	    $config = parse_ini_file($filename);
	    
	    if(empty($config['path_to_logs'])) { print("Variable \"path_to_logs\" missing from config."); die; }
	    
	    return $config;
	}
	
	function renderGraph($sizex, $sizey, $fin) {
	    ##echo "<pre>";
	    
	    exec("python logFormater.py $fin temp.log 2>&1",$output);
	    ##print_r($output);
	    unset($output);
	
	    $fout = "temp.jpg";
	    $gnuplotcmd = 'set xdata time;set timefmt "%s";set terminal jpeg size 2000,600;set output "' . $fout . '";set yrange [-10:];plot "temp.log" using 1:2:3 lc rgb variable';
	    $cmd = "echo abc && /usr/bin/gnuplot -e '$gnuplotcmd'  2>&1";
	    
	    ##print $cmd;
	    ##echo "<br><br>";
	    
	    exec($cmd, $output);
	    ##print_r($output);
	    unset($output);
	     
	    ##echo "<br><br>";
	    ##echo "</pre>";
	    return $fout;
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
		
	        $fname = renderGraph(800,600,$file);
	        ##echo "render complete?";
	    ?>
	
	    <script type="text/javascript">
		document.getElementById("loading").style.display = 'none';
	    </script>
	    
	    <img src="temp.jpg">
	
	</body>
</html>

