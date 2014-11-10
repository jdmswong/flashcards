<?php/* 
Caller variables recognized:
 * bool newDeckOption: assert default first "create new deck" option of value -1 
*/?>
        Select deck: 
        <select name="deckid">
<?php 
if(isset($newDeckOption) && $newDeckOption == true){
    ?>
            <option value="-1">Create new deck</option>
    <?php
}

function newScope(){
    require("dbinfo.inc");
    
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
