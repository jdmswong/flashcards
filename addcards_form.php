<!DOCTYPE html>
<html>

<head>

    <title> Welcome to Flashcards!</title>
    <link type="text/css" rel="stylesheet" href="css/reset.css"/>
    <link type="text/css" rel="stylesheet" href="css/main.css"/>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/addcards_form.js"></script>
</head>
<body>

    <?php require("header.php"); ?>
    
    
    Add flashcards:<br>
    <form id="add-card-form" method="post" action="addcards.php" enctype="multipart/form-data">
        Filename: <input type="file" name="input-file"/><br/>
        
        <?php $newDeckOption = true; require("inc/deckselect.inc"); ?>
        <div id="new-deck-title">
            New deck title: <input type="text" name="new-deck-title-input" />
        </div>
        <input type="submit" />
    </form>

    <?php require("footer.php"); ?>

</body>

</html>