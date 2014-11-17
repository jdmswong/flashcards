    <div id="wrap">
        <div id="main">
        
            
            <div id="header">
                <div id="page-title">
                    <a href="index.php" >FlashCard Suite</a>
                </div>
                    <?php if(isset($_COOKIE['name']) && isset($_COOKIE['userid'])){ ?>
                    <div id="user-corner">
                         <p>Hello <span id="name"><?php echo $_COOKIE['name']; ?></span>!</p> 
                    <a href="login.php" id="logout">Log out</a>
                    </div>
                    <?php } ?>
            </div>
                        
            <div id="content">
                
                <div id="center-area">
