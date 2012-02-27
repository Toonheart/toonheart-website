<script type='text/javascript'>
function RegisterFailure()
{
	alert("Email already registered. Thank you for your interest again!");
	window.open ('index.html','_self',false);
}
</script>


<?php
ini_set("SMTP","localhost");

include('configuration.php');

// table name 
$tbl_name= 'register_user';

// Random confirmation code 
$confirm_code=md5(uniqid(rand()));

// values sent from form

$email = $_POST['email'];


// Insert data into database 
$sql="INSERT INTO $tbl_name(confirm_code, email, status)VALUES('$confirm_code','$email',0)";
$result=mysql_query($sql);




// if suceesfully inserted data into database, send confirmation link to email 
if($result){

// ---------------- SEND MAIL FORM ----------------

// send e-mail to ...
$to=$email;

// Your subject
$subject="Signup confirmation - World Comication & Gamification!";

// From
$from="from: Toonheart Studios <signups@toonheart.com>";

// Your message
$message="Hi $email, \r\n";
$message.=" \r\n";
$message.="Thank you for signing up at www.toonheart.com \r\n";
$message.="Please click on the link below to confirm your signup and help us fight spam data. \r\n";
$message.="http://www.toonheart.com/confirmation.php?passkey=$confirm_code";
$message.=" \r\n";
$message.="-- \r\n";
$message.="Gamer Team \r\n";
$message.="Toonheart Studios \r\n";

// send email
$sentmail = mail($to,$subject,$message,$from);

}
else {
echo '<script type="text/javascript">'
 , 'RegisterFailure();'
 , '</script>';
$result = false;
}

return $result;

/*
// if your email succesfully sent
if($sentmail){
echo "Your Confirmation link Has Been Sent To Your Email Address.";
}
else {
echo "Cannot send Confirmation link to your e-mail address";
}
*/

?>
