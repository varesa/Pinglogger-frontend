<?php
    if($_GET['sizex'] == null) { 
	$sizex = 1000; 
    } else { 
	$sizex = $_GET['sizex'];
    }
    if($_GET['sizey'] == null) { 
	$sizey = 200; 
    } 
    else { 
	$sizey = $_GET['sizey'];
    }
?>

<h3>Graph</h3>
<?php
    print('<img src="graph.php?sizex=' . $sizex . '&sizey=' . $sizey . '">');
?>
<form action="index.php" method="get">
Graph size: x<input name="sizex" type="text" size=5 value="<?php echo $sizex; ?>">, y<input name="sizey" type="text" size=5 value="<?php echo $sizey; ?>"> <input type=submit value="refresh">
</form>
