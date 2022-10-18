<?php
/*$config['DBHostName'] = "localhost";
$config['DBUserName']= "root";
$config['DBPassword']= "";
$config['DBName']= "money_transfer";
*/

$config['DBHostName'] = "localhost";
$config['DBUserName'] = "root";
$config['DBPassword'] = "Root@123";
$config['DBName'] = "money_pot";
  
 
 $conn = @mysqli_connect($config['DBHostName'],$config['DBUserName'],$config['DBPassword'],$config['DBName']);

// mysqli_select_db($conn,$config['DBName']);

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}
  
 
?>