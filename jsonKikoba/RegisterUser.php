<?php
include "databaseConn.php";

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$fname = $obj['fname'];
$mname = $obj['mname'];
$sname = $obj['sname'];
$age = $obj['age'];
$phone = $obj['phone'];
$password = $obj['password'];
//response variables
$valid = true;
$invalidInput =" Inputs are not valid";
$pass ="Registration Is Successful";

//Validate inputs
  //validate First name
  if(empty($fname)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z]*$/",$fname)){
      $valid = false;
    }
  }
    //validate Middle name
    if(empty($mname)){
      $valid = false;
    }
    else{
      if(!preg_match("/^[a-zA-Z]*$/",$mname)){
        $valid = false;
      }
    }
      //validate Sir name
  if(empty($sname)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z]*$/",$sname)){
      $valid = false;
    }
  }
  //validate passwords
  if(empty($age)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[0-9]{2}$/",$age)){
      $valid = false;
    }
  }
    //validate email
    if(empty($phone)){
        $valid = false;
      }
      else{
        if(!preg_match("/^[0-9]{10}$/",$phone)){
          $valid = false;
        }
      }

if($valid == false){
//Alert err message
$arr = array('invalidInput'=>$invalidInput);
echo json_encode($arr);
}
else{
    //Update info in to the database
    $insert = "UPDATE users SET fname='$fname', mname='$mname',
    sname='$sname', age='$age', phone='$phone' WHERE passwords ='$password'";
    $insert_output = mysqli_query($conn,$insert);

//Alert granted message
$arr = array('granted'=>$pass);
    echo json_encode($arr);
}
?>
