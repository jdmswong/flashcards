<?php

function getDeckName($deckid){
    
    require("inc/dbinfo.inc");
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT name FROM decks WHERE deckid=?"); 
        
        $stmt->execute(array($deckid));
    
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
        $result = $stmt->fetch();
        
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
        
        return $result['name'];
    }

?>