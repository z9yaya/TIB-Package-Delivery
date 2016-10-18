<?php 
include '../functions/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Deliveries - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/deliveriescss.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
		<script type="text/javascript">
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>
    </head>
    <body>
        <div id="back_nav">
			<div id="wrapper">
				<header>
					<a id="login_blue" class="menu menu_blue" href="login.php"><?php 
																			if (session_id() == '')
																			{
																				session_start();
																			}
																			if(isset($_SESSION['email']))
																				echo 'SIGN OUT</a>';
																			else
																			{
																				header("Location: login.php?error=deliveries");
																				echo 'SIGN IN</a>';
																			}?>
					
						<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue selected" href="deliveries.php">DELIVERIES</a>
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
                                }
                                else if ($_SESSION['position'] == 'driver')
                                {
                                     echo '<a id="log" class="menu menu_blue" href="driver.php">LOG</a>';
                                }
                            }
                            else
                                    {
                                         echo '<a id="tracking" class="menu menu_blue" href="pages/tracking.php">TRACKING</a>
                                        <a id="new" class="menu menu_blue" href="pages/request.php">REQUEST</a>';	
                                    }
                        ?>
				
				</header>
					<div id="content">
					
      <?php
	  $servername = "localhost";
	  $username = "edit";
	  $password = "editme";
	  $dbname = "tib";

	  $conn = new mysqli($servername, $username, $password, $dbname);
	  
	  if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);}	  
	  ?>
	  
	  <?php
      $deliveryresult = GrabMoreData("SELECT * FROM delivery, package WHERE user = :email AND status != 'Delivered' AND delivery.ID = package.delivery_ID ", array(array(":email", $_SESSION['email'])));
	  
	  $statusresult = GrabMoreData("SELECT * FROM delivery, package WHERE user = :email AND status = 'Delivered' AND delivery.ID = package.delivery_ID ", array(array(":email", $_SESSION['email'])));	  	
	  
		if ($deliveryresult != false) 
		{
            echo '<h1>Ongoing Deliveries</h1>
	  <div id="table_holder">
      <table>
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>User</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Package Content</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>';
          foreach($deliveryresult as $row){
            echo
            "<tr>
              <td>$row[delivery_ID]</td>
			  <td>$row[user]</td>
			  <td>$row[origin]</td>
			  <td>$row[destination]</td>
			  <td>$row[name]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[pickup]) . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[dropoff]) . "</td>
			  <td>$row[cost]</td>
			  <td>$row[content]</td>
			  <td>$row[type]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[date_paid]) . "</td>
			  <td>$row[fragile]</td>
			  <td>$row[special]</td>
			  <td>$row[status]</td>
			  <td><a href='#' onclick=\"toggle_visibility('moreinfo');\">More Info</a></td>
			  <td><form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $row['delivery_ID'] ."'><input type='submit' class='button' value='Report Issue'></form></td>
              <td><a href='deliverychange.php?id=". $row['delivery_ID'] ."'>Change delivery details</a></td>
			</tr></tbody>
          </table></div><br>";
          }
		}
		else {
				echo "<br/>You have not requested a delivery yet..<br/><br/><br/><input type='button' onclick='(window.location.href = \"request.php\")' value='REQUEST A DELIVERY' class='button'/> ";
        }
        ?>

	
	<h1>Completed Deliveries</h1>

        <?php
		if ($statusresult != false) 
		{
            echo '<h1>Ongoing Deliveries</h1>
	  <div id="table_holder">
      <table>
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>User</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Package Content</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>';
          foreach($deliveryresult as $row){
            echo
            "<tr>
              <td>$row[delivery_ID]</td>
			  <td>$row[user]</td>
			  <td>$row[origin]</td>
			  <td>$row[destination]</td>
			  <td>$row[name]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[pickup]) . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[dropoff]) . "</td>
			  <td>$row[cost]</td>
			  <td>$row[content]</td>
			  <td>$row[type]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[date_paid]) . "</td>
			  <td>$row[fragile]</td>
			  <td>$row[special]</td>
			  <td>$row[status]</td>
			  <td><a href='#' onclick=\"toggle_visibility('moreinfo');\">More Info</a></td>
			  <td><form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $row[delivery_ID] ."'><input type='submit' class='button' value='Report<br/>Issue'></form></td>
              <td><a href='deliverychange.php?id=". $row[delivery_ID] ."'>Change delivery details</a></td>
			</tr></div></tbody>
    </table>";
          }
		}
		else {
				echo "No Results Found";} 
        ?>
        

    <?php $conn->close(); ?>
	


	<br>            
    </div>
    </div>
    <footer id="footer">
        <p> Designed by Michael Phong - 2016</p>
    </footer>	     
    </div>			   
    </body>
</html>