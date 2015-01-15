<?php 
if(!isset($_COOKIE['name']) && !isset($_COOKIE['userid'])){
    header("Location: login.php?msg=nocookie");
    exit;
}
?>