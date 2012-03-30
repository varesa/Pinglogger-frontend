<?php
    if($_GET['sizex'] == null) { 
	$sizex = 800; 
    } else { 
	$sizex = $_GET['sizex'];
    }
    
    if($_GET['sizey'] == null) { 
	$sizey = 600; 
    } else { 
	$sizey = $_GET['sizey'];
    }
    
    if($_GET['factor'] == null) {
	$factor = 10;
    } else {
	$factor = $_GET['factor'];
    }
    
    if($_GET['scale'] != null) {
	$mode=1:
    } else {				//If not scaling, must be fixed
	$mode=0;
    }
?>

<h3>Graph</h3>
<?php
    print('<img src="graph.php?sizex=' . $sizex . '&sizey=' . $sizey . '&factor=' . $factor . '&mode=' . $mode . '">');
?>
<form action="index.php" method="get">
    Graph size: 
    <table>
	<tr><td>Fixed: (default)&nbsp;&nbsp;</td>  <td> X<input name="sizex" type="text" size=5 value="<?php echo $sizex; ?>">, Y<input name="sizey" type="text" size=5 value="<?php echo $sizey; ?>"></td><td> <input name="fixed" type="submit" value="Set and refresh"></td></tr>
	<tr><td>Scale:</td>                        <td> Factor <input name="factor" type="text" size=8 value="<?php echo $factor; ?>"> </td><td> <input name="scale" type="submit" value="Scale and refresh"></td></tr>
	<tr><td></td><td> <input type="button" onclick="window.location.href='index.php'" value="Reset"></form></td></tr>
    </table>
</form>
