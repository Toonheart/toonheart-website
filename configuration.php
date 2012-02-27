<?

$host = "dummydatabaseserver"; //Hostname
$username = "dummyuser"; //Mysql user
$password = "dummypassword"; //Mysql password
$db_name = "dummydb"; //Database name


//Connect to server and select database
mysql_connect($host,$username,$password)or die("cannot connect to server");
mysql_select_db($db_name)or die("cannot select DB");

?>

