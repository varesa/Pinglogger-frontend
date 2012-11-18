<!DOCTYPE html>
<html>
	<head>
	    <script language="javascript" type="text/javascript" src="js/datetimepicker.js"></script>
	    <script language="javascript" type="text/javascript">
		function validate(form) {
		    var rbuttons = document.forms["logselect"]["file"];
		    for(var x = 0; x < rbuttons.length; x++) {
			if(rbuttons[x].checked) {
			    return true;
			}
		    }
		    alert("Please select the log to be viewed");
		    return false;
		}
	    </script>
	    
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
	
	<form name="logselect" method="get" action="view.php" onsubmit="return validate(this);">
	
	<table border=1 cellpadding=10>
	    <tr><td colspan=2>
	        <table style="width:100%;">
		    <th colspan=2>Please select a logfile to be viewed:</th>
	
		    <?php
			foreach(getFiles($config) as $file) {
			    print('<tr><td><input type="radio" name="file" value="' . $file . '"> ' . $file . "&nbsp;&nbsp;</td></tr>");
			}
		
		    ?>
		</table>
	    </td></tr>
	    <tr>
		<td> <!-- Date picker - begin -->
		    <b>Please select the beginning of the range:</b> <br>
		    <input type="text" id="date-begin" name="date-begin" size="25"> <a href="javascript:NewCal('date-begin', 'ddmmyyyy', true)"><img src="js/cal.gif" width=16 height=16 border=0 alt="Pick a date"></a>
		</td>
		<td> <!-- Date picker - end -->
		    <b>Please select the end of the range:</b> <br>
		    <input type="text" id="date-end" name="date-end" size="25"> <a href="javascript:NewCal('date-end', 'ddmmyyyy', true)"><img src="js/cal.gif" width=16 height=16 border=0 alt="Pick a date"></a>
		</td>
	
	    <tr>
		<td colspan=2>Show: <input type=submit name="selectedrange" value="Selected range"> <input type="submit" name="fullrange" value="Full file"></td>
	    </tr>
	</table>
	
	</form>

	</body>
</html>
