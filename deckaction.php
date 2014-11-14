<?php

/*
 * Action codes $_GET['action']:
 *  
 *  delete: 
 *      params: $_GET['deckids']=1,2,3,...
 *      delete deck(s)
 *  
 *  
 */


if($_GET['action'] == 'delete'){
    deleteDecks();
}

function deleteDecks(){
    if(!isset($_GET['deckids'])){
        die("ERROR: no deckids");
    }

    if(!preg_match('/^\d+(,\d+)*$/', $_GET['deckids'])){
        die("ERROR: \$_GET[deckids] improperly formatted");
    }

    $deckids = preg_split('/,/', $_GET['deckids']);

    if(count(array_unique($deckids))<count($deckids)){
        die("ERROR: No duplicate values");
    }
    
    require("inc/dbinfo.inc");
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM decks WHERE deckid=? ";
        for($i=0; $i<sizeof($deckids)-1; $i++){
            $sql .= "OR deckid=?";
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($deckids);
    
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    
    header("Location: deckoptions.php");
}
 
?>