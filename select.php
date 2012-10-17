<!DOCTYPE html>
<html>
	<head>
	    <script language="javascript" type="text/javascript" src="datetimepicker.js"></script>
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
	
	<table border=1>
	    <tr><td colspan=2>
	        <table style="width:100%;">
		    <th colspan=2>Please select a logfile to be viewed:</th>
	
		    <?php
			foreach(getFiles($config) as $file) {
			    print("<tr><td>" . $file . "&nbsp;&nbsp;</td><td align=\"right\"><a href='view.php?file=" . $file . "'>View</a></td></tr>");
			}
		
		    ?>
		</table>
	    </td></tr>
	    <tr>
		<td> <!-- Date picker - begin -->
		    <b>Please select the beginning of the range:</b> <br>
		    <input type="text" id="date-begin" size="25"> <a href="javascript:NewCal('date-begin', 'ddmmyyyy', true)"><img src="cal.gif" width=16 height=16 border=0 alt="Pick a date"></a>
		</td>
		<td> <!-- Date picker - end -->
		    <b>Please select the end of the range:</b> <br>
		    <input type="text" id="date-end" size="25"> <a href="javascript:NewCal('date-end', 'ddmmyyyy', true)"><img src="cal.gif" width=16 height=16 border=0 alt="Pick a date"></a>
		</td>
	</table>

	</body>
</html>
