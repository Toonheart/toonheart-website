<script type='text/javascript'>
function RegisterSuccess()
{
	alert("Thank you for confirming your subscription! \nPlease keep in touch on facebook and Twitter to get latest updates.");
	window.open ('index.html','_self',false);
}
function RegisterFailure()
{
	alert("Whoa! Invalid or Expired Confirmation code. Please try again!");
	window.open ('index.html','_self',false);
}
</script>


<?php

include('configuration.php');

// Passkey that got from link
$passkey=$_GET['passkey'];

$tbl_name="register_user";

// Retrieve data from table where row that match this passkey
$sql1="SELECT * FROM $tbl_name WHERE confirm_code ='$passkey'";
$result1=mysql_query($sql1);

// If successfully queried
if($result1){

// Count how many row has this passkey
$count=mysql_num_rows($result1);
}

// if found this passkey in our database, retrieve data from table "temp_members_db"
if($count==1){

// Insert data that retrieves from "temp_members_db" into table "registered_members"
$sql2="UPDATE $tbl_name SET status = '1' where confirm_code = '$passkey'";
$result2=mysql_query($sql2);
	
}

// if not found passkey, display message "Wrong Confirmation code"
else {
echo '<script type="text/javascript">'
 , 'RegisterFailure();'
 , '</script>';

}

// if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
if($result2){

// Delete information of this user from table "temp_members_db" that has this passkey
$sql3="UPDATE $tbl_name SET confirm_code = '0' where confirm_code = '$passkey' AND status = '1' ";
$result3=mysql_query($sql3);

echo '<script type="text/javascript">'
 , 'RegisterSuccess();'
 , '</script>';
}
?>

