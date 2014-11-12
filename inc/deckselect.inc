<?php/* 
Caller variables recognized:
 * bool newDeckOption:  assert default first "create new deck" option of value -1 
 * bool allDecksOption: assert "All decks" option of value "all"
*/?>
        Select deck: 
        <select name="deckid">
<?php 
if(isset($newDeckOption) && $newDeckOption == true){
    ?>
            <option value="-1">Create new deck</option>
    <?php
}

if(isset($allDecksOption) && $allDecksOption == true){
    ?>
            <option value="all">All decks</option>
    <?php
}

function newScope(){
    require("inc/dbinfo.inc");
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT deckid,name FROM decks"); 
        $stmt->execute();
    
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        
        foreach( $stmt->fetchall() as $rrow ){
            echo '<option value="'.$rrow["deckid"].'">'.$rrow["name"].'</option>';
        }
        
        
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
}
newScope();
?>
        </select><br/>