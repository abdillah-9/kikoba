<?php
include "databaseConn.php";

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$username = $obj['username'];
$password = $obj['password'];
$email = $obj['email'];

// Select from database
$query = "SELECT * FROM users WHERE emails = '$email' AND usename='$username'";
$query_output = mysqli_query($conn,$query);
$count = mysqli_num_rows($query_output);

$fail ="User Doesn't exists";
$pass ="Password has changed successfully";

if($count < 0){
  $arr = array('denied'=>$fail);
  echo json_encode($arr);
}

else{
    //insert data into the database
$insert = "UPDATE users SET passwords ='$password'
WHERE emails='$email' AND usename='$username'";
mysqli_query($conn,$insert);
$arr = array('granted'=>$pass);
echo json_encode($arr);
}
?>
