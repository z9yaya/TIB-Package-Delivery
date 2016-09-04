<!DOCTYPE html>
<html>
    <head>
        <title>drop.it</title>
        <link rel="SHORTCUT ICON" href="images/icon.ico" />
        <link rel="icon" href="images/icon.ico" type="image/ico" />
        <script async type="text/javascript" src="js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link async href="css/styles.css" rel="stylesheet" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
	</head>
    <body>
        <div id="back_nav">
            <div id="wrapper">
				<header>
					<a id="login" class="menu" href="pages/login.php"><?php 
                                                                        if (session_id() == '')
                                                                        {
                                                                            session_start();
                                                                        }
                                                                        if(isset($_SESSION['email']))
                                                                            echo 'SIGN OUT</a>';
                                                                        else 
                                                                            echo 'SIGN IN</a>';?>
					<a id="header" class="intro" href="index.php">drop.it</a>
					<a id="deliveries" class="menu" href="pages/deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu" href="pages/tracking.php">TRACKING</a>
					<a id="new" class="menu" href="pages/request.php">REQUEST</a>	
				</header>
				<a href="#" target="_blank" id="new_tab">Open in a new tab</a>
                    <div id="content">
						<div id="content_start">
							<div id="text_start">
							GIVE YOUR CLIENTS THE EARLIEST DELIVERY CONSISTENT WITH QUALITY <br> - WHATEVER THE INCONVENIENCE TO US.
							</div>
							<p id="by_start">
							ARTHUR C. NIELSEN</p>
						</div>
					<footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
                    </div>               
            </div>
        </div>
    </body>
</html>