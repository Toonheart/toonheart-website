<script type='text/javascript'>
function RegisterSuccess()
{
	alert("Thank you for subscribing. \nWe hope to deliver you entertaining games!");
	window.open ('index.html','_self',false);
}
function RegisterFailure()
{
	alert("Invalid E-mail address. Please try again!");
	window.open ('index.html','_self',false);
}
</script>


<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// session_start();

$email = $_POST['email'];



/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
	  /*
      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
	  */
	  else if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
	  {
		 $isValid = false;
	  }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

$message = validEmail($email);

if ($message == false )
	/*echo "Invalid E-mail address";*/
	echo '<script type="text/javascript">'
   , 'RegisterFailure();'
   , '</script>'; 
	/* RegisterFailure(); */
else if ($message == 1)
	/*echo "Thank you for subscribing. Now save some money to buy our games!";*/
	$store = include ('email.php');
	if($store) {
		echo '<script type="text/javascript">'
		   , 'RegisterSuccess();'
		   , '</script>';
	}
	else {
	}

?>

<!--
<script type='text/javascript'>
function ValidateEmail(inputText)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputText.value.match(mailformat))
{
document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.text1.focus();
return false;
}
}
</script>

-->
