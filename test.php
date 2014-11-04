<?php

echo "HELLO WORLD!<br>";

$servername = "127.0.0.1";
$username   = "jd";
$password   = "Awesomemysql123";
$dbname     = "flashcards";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo $e -> getMessage();
}

$conn = null; // close the connection
?>