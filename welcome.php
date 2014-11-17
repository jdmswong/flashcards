<?php require("inc/cookiecheck.inc"); ?>
<!DOCTYPE html>
<html>

<head>

    <title> Welcome to Flashcards!</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/common.js"></script>
</head>
<body>
    <?php require("header.php"); ?>
    
    Current options:<br>
    <ul>
        <li><a href="addcards_form.php">Add cards</a></li>
        <li><a href="deckoptions.php">Your decks</a></li>
        <li><a href="usecards.php">Use cards</a></li>
    </ul>
    
    <?php require("footer.php"); ?>
</body>