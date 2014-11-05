<?php

// if(!$_POST['inputFile']){
    // header("Location: addcards_form.html");
    // exit;
// }

$inputfile = "flashcardinput.txt";

$fh = fopen("flashcardinput.txt", "r") or die("Unable to open file!");

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

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // begin the transaction
    $conn->beginTransaction();
    // SQL statements
    foreach( $values as $rr ){
        $conn->exec("INSERT INTO flashcards (userid, front, back) VALUES (1,'".$rr[0]."','".$rr[1]."')");
    }
    
    $conn->commit();
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;


?>