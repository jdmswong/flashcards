<!DOCTYPE html>
<html>

<head>

	<title>Flashcards</title>
	<link type="text/css" rel="stylesheet" href="css/reset.css"/>
	<link type="text/css" rel="stylesheet" href="css/main.css"/>
	<script src="js/jquery-2.0.3.js"></script>
	<script src="js/main.js"></script>

    <script>
        var flashCards = 
<?php
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

    echo json_encode( $stmt->fetchAll() );
    
    
    $dsn = null;
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
    
?>;
        
    </script>
</head>

<body>
	
	<!--
	<div id="debug">
		DEBUG MENU
		<button style="button">TEST</button>
	</div>
	-->
	
	<div id="wrap">
		<div id="main">
		
			<!--
			<div id="header">
				header
			</div>
			-->
			
			<div id="content">
				<div id="game-area">
					<div id="title">Flashcards</div>
					
					<div id="header-stats">
						<div id="round-counter">Round 0</div>
						<div id="card-counter">1 of a billion</div>
					</div>
					
					<div id="flashcard"><p>SOME TEXT</p></div>
					
					<div id="control-panel">
						<button type="button" id="btn-correct">		Correct!	</button>
						<button type="button" id="btn-incorrect">	Incorrect!	</button>
						<button type="button" id="btn-skip">		Skip		</button>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
	
	<div id="footer">
		<div id="author-msg">Created by JD Wong.  Contact me via gmail (jdmswong)</div>
	</div>
	
</body>

</html>