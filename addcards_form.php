<!DOCTYPE html>
<html>

<head>

    <title> Welcome to Flashcards!</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/addcards_form.js"></script>
</head>
<body>

    <?php require("header.php"); ?>
    
    
    Add flashcards:<br>
    <form id="add-card-form" method="post" action="addcards.php">
        Filename: <input type="text" name="inputFile"/><br/>
        
        Select deck: 
        <select name="deck-select">
            <option value="-1">Create new deck</option>
<?php 
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

?>
        </select><br/>
        <div id="new-deck-title">
            New deck title: <input type="text" name="new-deck-title-input" />
        </div>
        <input type="submit" />
    </form>

    <?php require("footer.php"); ?>

</body>

</html>