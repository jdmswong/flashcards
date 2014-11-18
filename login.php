<?php
if(isset($_COOKIE['name']) && isset($_COOKIE['userid'])){
    header("Location: welcome.php");
    exit;
}else if( !isset($_POST['username']) && !isset($_POST['password']) ){
?>
<!DOCTYPE html>
<html>

<head>

    <title>Log-in</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/login.js"></script>
    

</head>
<body>        
<?php require("header.php"); 

if(isset($_GET['msg'])){
    echo '<span class="form-msg">';
    switch($_GET['msg']){
        case "newuser":
            echo "Your account has been added!  Please log in to continue";
            break;
        case "badlogin":
            echo "Invalid username or password, please try again";
            break;
    }
    echo '</span><br>';
}

?>

<div id="title">Please log in:</div>
<form method="post" action="<?php echo basename(__FILE__); ?>">
    Username: <input type="text" id="username" name="username" /><br>
    Password: <input type="password" id="password" name="password" /><br>
    <input type="submit" value="Submit"/>
    <input type="button" id="btn-newuser" value="New user?"/>
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
            //echo var_dump($_SERVER['HTTP_HOST']);
            
            // Bake up a cookie
            $cookie_expire = time()+86400; // 24 hr life
            //time() - 3600; // overdue expiration date. deletes cookie
            $cookie_domain = $_SERVER['HTTP_HOST'];
            
            /*
             * SERVER_NAME: localhost
             * ["HTTP_HOST"]=> string(14) "localhost:8080"
             */
            
            //setcookie($cookie_name, $cookie_value, $cookie_expire, "/" , $cookie_domain, 0);
            setcookie("userid", $result[0]["id"], $cookie_expire, $cookie_domain);
            setcookie("name", $result[0]["name"], $cookie_expire, $cookie_domain);
            
            
            header("Location: welcome.php");
            exit;
        }else{
            // Login failure
            header("Location: login.php?msg=badlogin");
            exit;
        }
        
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    
}
?>