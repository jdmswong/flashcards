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
    
    <div id="add-form-div">
        Add flashcards:<br>
        <form id="add-card-form" method="post" action="addcards.php" enctype="multipart/form-data">
            <input type="radio" name="input-method" id="radio-upload" value="upload">File Upload</input>, 
            <input type="radio" name="input-method" id="radio-manual" value="manual" checked="checked">Manual entry</input><br>
            
            <div id="file-upload">
                Filename: <input type="file" name="input-file"/><br/>
            </div>
            

            <textarea id="card-input" name="card-input" cols="40" rows="10">
card 1 front, card 1 back
card 2 front, card 2 back
card 3 front, card 3 back
( and so on... )</textarea>
            
            <?php $newDeckOption = true; require("inc/deckselect.inc"); ?>
            <div id="new-deck-title">
                New deck title: <input type="text" name="new-deck-title-input" />
            </div>
            <input type="submit" />
        </form>
    </div>

    <?php require("footer.php"); ?>

</body>

</html>