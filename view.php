<!DOCTYPE html>
<html>
	<?php
	
	function getConfig($filename) {
	    if(!is_file($filename)) { print "Config file viewer.conf not present"; }
	    $config = parse_ini_file($filename);
	    
	    if(empty($config['path_to_logs'])) { print("Variable \"path_to_logs\" missing from config."); die; }
	    
	    return $config;
	}
	
	function renderGraph($sizex, $sizey, $limitedrange, $fin) {
	    
	    exec("python logFormater.py $fin temp.log 2>&1",$output);
	    unset($output);
	
	    $fout = "temp.jpg";
	    	    
	    if($limitedrange !== false) {
		$xrange = 'set xrange ["' . $limitedrange[0] . '":"' . $limitedrange[1] . '"]; ';
	    } else {
		$xrange = "";
	    }
	    
	    $gnuplotcmd = 'set xdata time;set timefmt "%s"; set terminal jpeg size 2000,600; set output "' . $fout . '"; set xzeroaxis lt 20; set yrange [-10:]; ' . $xrange . 'plot "temp.log" using 1:2:3 lc rgb variable';
	    #echo $gnuplotcmd;
	    $cmd = "/usr/bin/gnuplot -e '$gnuplotcmd'  2>&1";
	    
	    exec($cmd, $output);
	    if(count($output) > 1) {
		print('GNUPlot gave errors:<br>');
    		print( join('<br>', $output) );
    	    }
	    unset($output);
	     
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
	
	#$selectedrange = 0;
	
	if( isset($_GET['selectedrange']) ) {
	    $selectedrange = true;
	    if( isset($_GET['date-begin']) && isset($_GET['date-end']) ) {
		$rangebegin = strtotime($_GET['date-begin']);
		$rangeend   = strtotime($_GET['date-end']);
	    } else {
		exit('When selecting a range the beginning and the end of the range must be specified');
	    }
	} else {
	    $selectedrange = false;
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
		
		if ( $selectedrange ) {
		    $fname = renderGraph(800,600,array($rangebegin, $rangeend),$file);
		} else {
		    $fname = renderGraph(800,600,false,$file);
		}
	    ?>
	
	    <script type="text/javascript">
		document.getElementById("loading").style.display = 'none';
	    </script>

	    <?php
		if($selectedrange) {
		    print('<p>A graph from time between ' . date("d-m-y H:i:s", $rangebegin) . ' and  ' . date("d-m-y H:i:s", $rangeend) . ' :</p>');
		}
	    ?>

	    <img src="<?php print($fname); ?>">
	
	</body>
</html>

