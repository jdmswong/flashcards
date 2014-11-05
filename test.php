<?php

echo "HELLO WORLD!<br>";

$matrix = array();
for ($i=0; $i < 5; $i++) { 
	$tokens = array($i,$i+1,$i+2);
    array_push($matrix, $tokens);
}

foreach( $matrix as $row){
    echo $row[0]," ",$row[1],"\n";
}


?>