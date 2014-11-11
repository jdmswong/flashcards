<!DOCTYPE html>
<html>

<head>

    <title> View your flashcards</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script>
<?php



?>
        
    </script>
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

    echo '<table id="card-table">';
    echo "<tr><th>Card Front</th><th>Card back</th></tr>";
    
    class TableRows extends RecursiveIteratorIterator { 
        function __construct($it) { 
            parent::__construct($it, self::LEAVES_ONLY); 
        }
    
        function current() {
            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
        }
    
        function beginChildren() { 
            echo "<tr>"; 
        } 
    
        function endChildren() { 
            echo "</tr>" . "\n";
        } 
    } 
    
    require("dbinfo.inc");
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset( $_GET['deckid']) ){
            $sql = "SELECT front,back FROM flashcards WHERE deckid=?";
            $stmt = $conn->prepare($sql); 
            $stmt->bindValue(1, $_GET['deckid']);
        }else{
            $sql = "SELECT front,back FROM flashcards";
            $stmt = $conn->prepare($sql); 
        }
        $stmt->execute();
    
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    
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


