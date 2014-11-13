<!DOCTYPE html>
<html>

<head>

    <title>Your Decks</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/deckoptions.js"></script>
    
</head>
<body>
    
<?php require("header.php"); ?>

<form method="get" action="<?php echo basename(__FILE__); ?>" >
    Your decks:<br>
    
    <table id="tbl-deck-select">
        <tr><th><input type="checkbox" name="select-all" id="select-all"/></th>
            <th>Deck Name</th><th>Cards</th></tr>
        <?php 
        require("inc/dbinfo.inc");
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("
                SELECT decks.deckid,name,count(*) AS cards
                FROM decks JOIN flashcards ON decks.deckid = flashcards.deckid
                GROUP BY decks.deckid
            "); 
            $stmt->execute();
        
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            
            foreach( $stmt->fetchall() as $rrow ){
                echo '
                    <tr>
                        <td><input type="checkbox" name="deckid" value="'.$rrow['deckid'].'/>"</td>
                        <td><a href="viewcards.php?deckid='.$rrow['deckid'].'"">'.$rrow['name'].'</a></td>
                        <td>'.$rrow['cards'].'</td>
                    </tr>
                ';
            }
            
            
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        
        
        foreach($_GET as $k=>$v){
            echo '<input type="hidden" name="'.$k.'" value="'.$v.'" />';
        }
        ?>
    </table><br>
    <!-- <input type="submit" /> -->
</form>


<?php require("footer.php"); ?>

</body>