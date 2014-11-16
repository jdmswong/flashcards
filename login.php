<?php
if( !isset($_POST['username']) && !isset($_POST['password']) ){
?>
<!DOCTYPE html>
<html>

<head>

    <title>Flashcards</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    

</head>
<body>        
<?php require("header.php"); ?>

<div id="title">Please log in:</div>
<form method="post" action="<?php echo basename(__FILE__); ?>">
    Username: <input type="text" id="username" name="username" /><br>
    Password: <input type="password" id="password" name="password" /><br>
    <input type="submit" />
</form> 

<?php require("footer.php"); ?>      
    
</body>

</html>
<?php 
}else{
    require("inc/dbinfo.inc");
    
    $fc_username = trim($_POST['username']);
    $fc_password = trim($_POST['password']);
    
    $hashedPass = hash( "sha256", $fc_password );
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->execute(array($fc_username,$hashedPass));
    
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();
        
        if(sizeof($result) == 1){
            // Login success!
            header("Location: welcome.php");
        }else{
            header("Location: login.php");
        }
        
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    
}
?>