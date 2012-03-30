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

$graph = new Graph(1280,720);

$graph->SetScale('datelin');
$graph->SetTickDensity(TICKD_DENSE,1);
$graph->xaxis->SetLabelAngle(90);
$graph->xaxis->SetLabelAlign('right','top','right');

$graph->SetMargin(40,20,20,200);

$xvalues = Array();

foreach(array_keys($pings) as $num => $epoch) {
  $xvalues[$num] = date("H:i:s",$epoch);
}

//print_r($xvalues);

$plot = new LinePlot(array_values($pings),array_keys($pings));
$plot->SetColor('black');

$graph->Add($plot);

$graph->Stroke();

//print_r($pings);

?> 
