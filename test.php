<?php

echo "HELLO WORLD!<br>";

require("inc/dbinfo.inc");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT deckid,name FROM decks"); 
    $stmt->execute();

    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
    //nl2br( var_dump($stmt->fetch())."\n" );
    
    foreach( $stmt->fetchall() as $rrow ){
        echo '<option value="'.$rrow["deckid"].'">'.$rrow["name"].'</option>';
        // echo "--------------<br>";
        // nl2br( var_dump($rrow)."\n" );
    }
    
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

?>
