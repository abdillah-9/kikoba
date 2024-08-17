<?php
include "databaseConn.php";

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$username = $obj['username'];
$password = $obj['password'];
$email = $obj['email'];

// Select from database
$query = "SELECT * FROM user WHERE passwords = '$password' AND emails='$email'";
$query_output = mysqli_query($conn,$query);
$count = mysqli_num_rows($query_output);

$valid = true;
$invalidInput = "Inputs not valid";
$fail ="This User Doesn't Exist";
$pass ="User Is Successfully Deleted";

//Validate inputs
  //validate username
  if(empty($usernames)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z]*$/",$username)){
      $valid = false;
    }
  }
  //validate passwords
  if(empty($passwords)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z0-9]*$/",$password)){
      $valid = false;
    }
  }
    //validate email
    if(empty($email)){
        $valid = false;
      }
      else{
        if(!preg_match("/[@,a-z0-9]*/",$email)){
          $valid = false;
        }
      }

if($vaid == false){
$arr = array('invalidInput'=>$invalidInput);
echo json_encode($arr);
}

else{
if($count < 0){
  $arr = array('denied'=>$fail);
  echo json_encode($arr);
}

else{
  //insert data into the database
$insert = "DELETE FROM user WHERE passwords = '$password'";
mysqli_query($conn,$insert);
$arr = array('granted'=>$pass);
echo json_encode($arr);
}
}
?>
