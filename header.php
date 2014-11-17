    <div id="wrap">
        <div id="main">
        
            
            <div id="header">
                <div id="page-title">
                    <a href="index.php" >FlashCard Suite</a>
                </div>
                <div id="user-corner">
                    <?php if(isset($_COOKIE['name'])) {
                         echo '<p>Hello <span id="name">' . $_COOKIE['name'] . '</span>!</p>'; 
                    } ?>
                </div>
            </div>
                        
            <div id="content">
                
                <div id="center-area">
