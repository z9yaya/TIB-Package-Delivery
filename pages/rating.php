<?php include '../functions/functions.php';
include '../functions/uploadfile.php';
 require '../functions/mail/PHPMailerAutoload.php';

 if (isset($_POST) && !empty($_GET['delivery'])){
	if (session_id() == '')
    {
        session_start();
    }
    if (isset($_POST) && isset($_SESSION))
            {
                 if (!empty($_POST) && !empty($_SESSION) && !empty($_GET['delivery']) && !empty($_SESSION['email']))
                    {
                        $account="dropitdeliveries@gmail.com";//source email, DO NOT CHANGE
                        $password="drop.itsupport";//source password, DO NOT CHANGE
                        $to="eliasrihan@yahoo.com";//recipient
                        $email = $_SESSION['email'];
                        $from = $email; //reply to email
                        $name = GrabData("users","name","email",  $email);
                        $name = $name[0]['name'];
                        $from_name= $name; //From name
						$file_to_attach = "";
					if ($_FILES["fileToUpload"]["error"] != 4)
						{	
							$file_to_attach = uploadFile();
						}
						if ($file_to_attach == "upload_error")
						{
							echo "<script>alert('Sorry, there was an error uploading your file. Please report this issue.');</script>";
						}
						else if ($file_to_attach == "upload_invalid")
						{
							echo "<script>alert('Sorry, your file was either too big or not supported.');</script>";
						}
						else
						{
							$review = $_POST['review'];
							$delivery_rating = $_POST['delivery_rating'];
							$package_rating = $_POST['package_rating'];
							$date = date('H:i d/m/Y');
							$msg= htmlspecialchars($review . "\n Package Rating:" . $package_rating . "\n Delivery Rating:" . $delivery_rating); // HTML message
							$subject="Delivery Review: " . $_GET['delivery'] . " at " . $date;//email subject
							$mail = new PHPMailer();
							$mail->IsSMTP();
							$mail->CharSet = 'UTF-8';
							$mail->Host = "smtp.gmail.com";
							$mail->SMTPAuth= true;
							$mail->Port = 465;
							$mail->Username= $account;
							$mail->Password= $password;
							$mail->SMTPSecure = 'ssl';
							$mail->addReplyTo($email, $name);
							$mail->FromName = $name;
							$mail->isHTML(true);
							$mail->Subject = $subject;
							$mail->Body = $msg;
							$mail->addAddress($to);
							
							$mail->AddAttachment($file_to_attach , strtolower(pathinfo($file_to_attach,PATHINFO_EXTENSION)));
							if(!$mail->send())
							{
								echo "Mailer Error: " . $mail->ErrorInfo;
							}
							else
							{
								unlink($file_to_attach);
								echo "E-Mail has been sent";
								header("Location: deliveries.php");
							}
						}
                 }
}
 }
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Rating - drop.it</title>		
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
		<?php if (session_id() == '')
            {
                session_start();
            }
            if(isset($_SESSION['position']) && $_SESSION['position'] == 'driver')
            {
                echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                        <meta http-equiv="Pragma" content="no-cache" />
                        <meta http-equiv="Expires" content="0" />
                        <script type="text/javascript" src="../functions/chat/scriptPages.js"></script>';
            }
			if(isset($_GET['delivery'])){
			$id = $_GET['delivery'];
				}
			?>
			
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/rating.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
<body>
<div id="alert_background">															
<div id="alert"><span>Please wait while we submit your feedback. Thank You!<br></span></div>
</div>
        <div id="back_nav">
			<div id="wrapper">
				<?php include "../functions/header.php";?>
<div id="content">  
<div id="form">
                        <span class="sign_title">Leave feedback for delivery ID: <?php echo $id?></span>


<div id="fieldset_title">						
	<form action="rating.php?delivery=<?php echo $id;?>" id="ratingForm" method="POST" name="form" enctype="multipart/form-data" onsubmit="document.getElementById('alert_background').style.display='block';">
			<textarea id="msg" name="review" class="reviewmsg input_text textarea text_long" placeholder="Please type your thoughts here......"></textarea>

			<input type="file" name="fileToUpload" class="input_text" id="fileToUpload">
			<!--<input type="submit" value="Upload Image" name="submit">-->
			<br>		
			
			<h2><strong class="choice">Delivery Quality:</strong></h2>
		<fieldset id="rating" onchange="showSelectedRating('value')">
			<input type="radio" id="star5" value="5" name="delivery_rating" title="Amazing"/><label for="star5" title="Amazing">&#9733;</label>
			<input type="radio" id="star4" value="4" name="delivery_rating" title="Good"/><label for="star4" title="Good">&#9733;</label>
			<input type="radio" id="star3" value="3" name="delivery_rating" title="Average"/><label for="star3" title="Average">&#9733;</label>
			<input type="radio" id="star2" value="2" name="delivery_rating" title="Bad"/><label for="star2" title="Bad">&#9733;</label>
			<input type="radio" id="star1" value="1" name="delivery_rating" title="Terrible"/><label for="star1" title="Terrible">&#9733;</label>
		</fieldset>

		
		<h2><strong class="choice">Package Quality:</strong></h2>
		<fieldset id="rating_package" onchange="showSelectedRating('value')">
			<input type="radio" id="star5_1" value="5" name="package_rating" title="Amazing"/><label for="star5_1" title="Amazing">&#9733;</label>
			<input type="radio" id="star4_1" value="4" name="package_rating" title="Good"/><label for="star4_1" title="Good">&#9733;</label>
			<input type="radio" id="star3_1" value="3" name="package_rating" title="Average"/><label for="star3_1" title="Average">&#9733;</label>
			<input type="radio" id="star2_1" value="2" name="package_rating" title="Bad"/><label for="star2_1" title="Bad">&#9733;</label>
			<input type="radio" id="star1_1" value="1" name="package_rating" title="Terrible"/><label for="star1_1" title="Terrible">&#9733;</label>
		</fieldset><br><br><br>
			<input type="submit" name="submit"  id="submit" class="button" value="Submit">
	</form>
</div>

		</div>
	  </div>
	</div>
	<?php AddChat();
    include "../functions/footer.php"?>
	</div>
</body>
</html> 
