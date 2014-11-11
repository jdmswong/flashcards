<!DOCTYPE html>
<html>

<head>

	<title>Flashcards</title>
	<link type="text/css" rel="stylesheet" href="css/reset.css"/>
	<link type="text/css" rel="stylesheet" href="css/main.css"/>
	<script src="js/jquery-2.0.3.js"></script>
	<script src="js/usecards.js"></script>

    <script>
        
<?php
require("dbinfo.inc");

if(isset($_GET['deckid'])){

echo "var flashCards = ";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_GET['deckid'] == 'all'){
        $stmt = $conn->prepare("SELECT front,back FROM flashcards"); 
    }else{
        $stmt = $conn->prepare("SELECT front,back FROM flashcards WHERE deckid=?");
        $stmt->bindValue(1, $_GET['deckid']);
    }
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    echo json_encode( $stmt->fetchAll() );
    
    
    $dsn = null;
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

echo ";";

}    
?>
        
    </script>
</head>

<body>
	
	<!--
	<div id="debug">
		DEBUG MENU
		<button style="button">TEST</button>
	</div>
	-->
	
<?php 
require("header.php");
if(isset($_GET['deckid'])){
?>			    
			    
	<div id="title">Flashcards</div>
	
	<div id="header-stats">
		<div id="round-counter">Round 0</div>
		<div id="card-counter">1 of a billion</div>
	</div>
	
	<div id="flashcard"><p>SOME TEXT</p></div>
	
	<div id="control-panel">
		<div class="inline-wrapper">
		    <button type="button" id="btn-correct">		Correct!	</button>
		    <div class="card-counter" id="correct-counter">0</div>
        </div>
		<div class="inline-wrapper">
		    <button type="button" id="btn-incorrect">	Incorrect!	</button>
		    <div class="card-counter" id="incorrect-counter">0</div>
		</div>
		<button type="button" id="btn-skip">		Skip		</button>
	</div>
				
    <div id="key-info">
        <h1>Keyboard controls:</h1>
        <table>
            <tr><th>Skip</th><th>Correct</th><th>Incorrect</th><th>Flip card</th></tr>
            <tr><td>a</td><td>s</td><td>d</td><td>f</td></tr>
        </table>
    </div>

<?php 
}else{
    $allDecksOption = true;
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

</html>