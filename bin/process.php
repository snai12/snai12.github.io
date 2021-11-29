<?php
if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
	$name = stripslashes(strip_tags($_POST['name']));
} else {$name = 'No name field entered';}

if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
  $email = stripslashes(strip_tags($_POST['email']));
} else {$email = 'No email field entered';}

if ((isset($_POST['subject'])) && (strlen(trim($_POST['subject'])) > 0)) {
  $subject = stripslashes(strip_tags($_POST['subject']));
} else {$subject = 'No subject field entered';}

if ((isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0)) {
	$message = $_POST['message'];
} else {$message = 'No message entered';}

$ip=$_SERVER['REMOTE_ADDR'];
if ((isset($_POST['form'])) && (strlen(trim($_POST['form'])) > 0)) {
	$form = stripslashes(strip_tags($_POST['form']));
} else {$form = 'No form entered';}
ob_start(); 

?>
<html>
<head>
<style type="text/css">
</style>
</head>
<body>
<div>
<table width="550" border="1" cellspacing="2" cellpadding="2">

  <tr bgcolor="#eeffee">
    <td>Name</td>
    <td><?php echo $name; ?></td>
  </tr>     
  <tr bgcolor="#eeeeff">
    <td>Email</td>
    <td><?php echo $email; ?></td>
  </tr>
  <tr bgcolor="#eeffee">
    <td>Subject</td>
    <td><?php echo $subject; ?></td>
  </tr>
<tr bgcolor="#eeeeff">
    <td>Message</td>
    <td><?php echo $message; ?></td>
</tr> 
<tr bgcolor="#ffffee">
    <td>IP Address</td>
    <td><?php echo $ip; ?></td>
</tr>
</table></body>
</html>
</div>
<?php
if(isset($_POST['url']) && $_POST['url'] == ''){
$body = ob_get_contents();
$to = "info@raptivate.com";
$fromaddress = "info@raptivate.com";
$fromname = "Raptivate Contact Form";

require_once("phpmailer.php");
// grab recaptcha library
require_once("recaptchalib.php");


// empty response
$response = null;
 $secret = "6LdntzMUAAAAAKWluntwiS91yu1tMkF43cJNMkUp";


// check secret key
$reCaptcha = new ReCaptcha($secret);


if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
 if ($response != null && $response->success) {
    $mail = new PHPMailer();
$mail->From     = $email;
$mail->FromName = $name;
$mail->AddAddress("info@raptivate.com","Name 1");
$mail->AddBCC("mukhtar@raptivate.com","Name 1");
$mail->AddBCC("grib@raptivate.com","Name 1");
$mail->AddBCC("navedmirza25@gmail.com","Name 1");
$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject  =  'Raptivate Contact Form';
$mail->Body     =  $body;
$mail->AltBody  =  "This is the text-only body";
if(!$mail->Send()) {
	$recipient = "info@raptivate.com";
	$subject = 'Contact form failed';
	$content = $body;	
  mail($recipient, $subject, $content, "From: mail@yourdomain.com\r\nReply-To: $email\r\nX-Mailer: DT_formmail");  
  
}
header('Location:'.$_POST['redirect']) ;
  } else {
   echo "Have a good Day! 1";
   exit;
  }


}
else{
	echo "Have a good Day!";
}
?>
