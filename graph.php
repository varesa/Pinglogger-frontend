<?php
require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_line.php');
require_once('jpgraph/jpgraph_date.php');
$file = file("log");			// Load a file with the values

$pings = Array();			// Initialise an array for -||-

foreach($file as $line) {		// Read the file line by line
  $values = explode(" ", $line);	// to the array
  $pings[trim($values[0])] = trim($values[1]);
}

ksort($pings);				// Make sure that the values are
					// chronological order


if($_GET['mode'] == 1) {		// Fixed mode
    $graph = new Graph($_GET['sizex'],$_GET['sizey']);
} elseif($_GET['mode'] == 2) {		// Scaled mode
    $graph = new Graph(count($pings)/50*$_GET['factor'],$_GET['sizey']);
} else {
    $graph = new Graph(800,600);
}

$xsize = $graph->img->plotwidth;
$count = count($pings);
print($xsize . ", " . $count);

echo "<br>";

print(floor($count/$xsize) . " values per x-value + " . $count%$xsize);

echo "<br>";

for($x=0;$x<$xsize;$x++) {
    $values = array_splice($pings, );
    if(  array_values($pings)[ floor($count/$xsize) * $x ]  -  array_values($pings)[$x]  ==  )
    print(max(array_values(array_slice($pings, $x*floor($count/$xsize)-1, floor($count/$xsize)))) . "<br>");
}

$graph->SetScale('datelin');
$graph->SetTickDensity(TICKD_DENSE,1);
$graph->xaxis->SetLabelAngle(90);
$graph->xaxis->SetLabelAlign('right','top','right');

$graph->SetMargin(40,20,20,70);


$plot = new LinePlot(array_values($pings),array_keys($pings));
$plot->SetColor('black');

$graph->Add($plot);

//$graph->Stroke();

?>