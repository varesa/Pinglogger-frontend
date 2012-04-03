<?php
header('Content-disposition: attachment; filename=graph.png');
header('Content-type: image/png'); 
passthru('php graph.php');
?>