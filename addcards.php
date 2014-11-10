<?php

$inputfile = $_POST['inputFile'];
$currentUserID = 1;

$fh = fopen($inputfile, "r") or die("Unable to open file!");

$values = array();
while( !feof( $fh) ){
    $readline = fgets($fh);
    if(preg_match('/,/', $readline)){
        $tokens = preg_split('/\s*,\s*/', trim($readline));
        array_push( $values, $tokens);
    }
}

fclose($fh);

require("dbinfo.inc");

$e=null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "\$_POST['new-deck-title-input']=".$_POST['new-deck-title-input']."<br>";
    
    // get/create deck
    $deckid = -1;
    if($_POST['deckid'] == -1){
        
        $stmt_newDeck = $conn->prepare(
            "INSERT INTO decks(userid,name) VALUES(?,?)"
        );
        $result = $stmt_newDeck->execute(array($currentUserID, $_POST['new-deck-title-input']));
        
        $stmt_getDeckID = $conn->prepare("SELECT deckid FROM decks WHERE userid=? AND name=?");
        $stmt_getDeckID->execute(array($currentUserID, $_POST['new-deck-title-input']));

        // set the resulting array to associative
        $stmt_getDeckID->setFetchMode(PDO::FETCH_ASSOC); 
        $rrow = $stmt_getDeckID->fetch();
        
        $deckid = $rrow["deckid"];
    }else{
        $deckid = $_POST['deckid'];
    }

    // begin the transaction
    $conn->beginTransaction();
    // SQL statements
    $stmt = $conn->prepare("INSERT INTO flashcards (userid, deckid, front, back) VALUES (1,?,?,?)");
    foreach( $values as $rr ){
       $stmt->execute(array($deckid, $rr[0], $rr[1]));
    }
    
    $conn->commit();
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

if($e == null){
    header("Location: viewcards.php?status=added&deckid=".$deckid);
    exit;
}

?>