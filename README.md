flashcards
==========

One of my favorite study tools, the longest part is the arts and crafts of making the things.  Digital solution ahead!

To implement this on your own system, be sure to create inc/dbinfo.inc containing:
<?php 
$servername = server ip or path
$username   = mysql user
$password   = password for user
$dbname     = database this app will be using
?>

Create an empty DB by with the mysql command "CREATE database_name;"

Next, on the command line be sure to import the database schema into an empty DB with:
$> mysql -u username -p database_name < mysql/dbdump.sql

That's it!