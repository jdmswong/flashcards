<!DOCTYPE html>
<html>

<head>

    <title> Welcome to Flashcards!</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
</head>
<body>

    <?php require("header.php"); ?>
    
    Add flashcards:<br>
    <form method="post" action="addcards.php">
        Filename: <input type="text" name="inputFile"/>
        <input type="submit" />
    </form>
        
    <?php require("footer.php"); ?>

</body>

</html>