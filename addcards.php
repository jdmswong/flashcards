<?php

if(!$_POST['inputFile']){
    header("Location: addcards_form.html");
    exit;
}

$inputfile = $_POST['inputFile'];

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

// print_r($values);
// exit;

$servername = "127.0.0.1";
$username   = "jd";
$password   = "Awesomemysql123";
$dbname     = "flashcards";

$e=null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // begin the transaction
    $conn->beginTransaction();
    // SQL statements
    $stmt = $conn->prepare("INSERT INTO flashcards (userid, front, back) VALUES (1,?,?)");
    foreach( $values as $rr ){
       $stmt->execute(array($rr[0],$rr[1]));
    }
    
    $conn->commit();
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

if($e == null){
    header("Location: viewcards.php?status=added");
    exit;
}

?>