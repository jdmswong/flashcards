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

if(isset($_GET['status'])){
    $msg = '';
    switch($_GET['status']){
        case 'added':
            $msg = "Records successfully added!";
            break;
    }
    echo $msg."<br/>";
}

echo "<table>";
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


$servername = "127.0.0.1";
$username   = "jd";
$password   = "Awesomemysql123";
$dbname     = "flashcards";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT front,back FROM flashcards"); 
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

require("footer.php");
?>

</body>


