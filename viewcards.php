<?php require("inc/cookiecheck.inc"); ?>
<!DOCTYPE html>
<html>

<head>

    <title> View your flashcards</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/common.js"></script>
</head>
<body>
<?php
require("header.php");

if(isset($_GET['deckid'])){

    if(isset($_GET['status'])){
        $msg = '';
        switch($_GET['status']){
            case 'added':
                $msg = "Records successfully added!";
                break;
        }
        echo $msg."<br/>";
    }

    require("inc/getdeckname.inc");
    echo '<div id=title>'.
        ($_GET['deckid'] == 'all' ? "All Decks" : getDeckName($_GET['deckid'])) . "</div>";

    echo '<table id="card-table">';
    
    class TableRows extends RecursiveIteratorIterator { 
        function __construct($it) { 
            parent::__construct($it, self::LEAVES_ONLY); 
        }
    
        function current() {
            return "<td>" . parent::current(). "</td>";
        }
    
        function beginChildren() { 
            echo "<tr>"; 
        } 
    
        function endChildren() { 
            echo "</tr>" . "\n";
        } 
    } 
    
    require("inc/dbinfo.inc");
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $tableCols = array();
        if( $_GET['deckid'] == 'all' ){
            $tableCols = array("Deck name","front","back");
            $sql = "
                SELECT decks.name,front,back 
                FROM flashcards JOIN decks ON decks.deckid = flashcards.deckid
                ORDER BY decks.deckid, cardid ";
            $stmt = $conn->prepare($sql); 
        }else{
            $tableCols = array("front","back");
            $sql = "SELECT front,back FROM flashcards WHERE deckid=?";
            $stmt = $conn->prepare($sql); 
            $stmt->bindValue(1, $_GET['deckid']);
        }
        $stmt->execute();
    
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
        echo "<tr>";
        foreach($tableCols as $colName){
            echo "<th>".$colName."</th>";
        }
        echo "</tr>";
        
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
            echo $v;
            
        }
        }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
        }
    $conn = null;
    
    echo "</table>";
}else{
    ?>
    Choose a deck:
    <form method="get" action="<?php echo basename(__FILE__); ?>" >
        <?php 
        $allDecksOption = true;
        require("inc/deckselect.inc"); 
        foreach($_GET as $k=>$v){
            echo '<input type="hidden" name="'.$k.'" value="'.$v.'" />';
        }
        ?>
        <input type="submit" />
    </form>
    <?php    
}

require("footer.php");
?>

</body>


