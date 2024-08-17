<?php
include "databaseConn.php";

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$invaidInput = "Input is not valid";
$fail = "You can't receive loan unti you pay previous debt";
$fail2 = "You can't access loan that is higher than 90% of your contribution";
$pass ="Loan has already deposited to your account";
$valid = true;

$password = $obj['password'];
$amount = $obj['amount'];

//Get id from user password
$obtainId = "SELECT * FROM users WHERE passwords='$password'";
$obtainIdQuery = mysqli_query($conn,$obtainId);
if(mysqli_num_rows($obtainIdQuery) > 0){
  while($myid = mysqli_fetch_assoc($obtainIdQuery)){
    $id = $myid["id"];
    $fname = $myid["fname"];
    $mname = $myid["mname"];
    $sname = $myid["sname"];
    $phone = $myid["phone"];

  }
}
$userID = $id;

//Validate inputs
  //validate username
  if(empty($amount)){
    $valid = false;
  }
  else{
    if(!preg_match("/^[0-9]*$/",$amount)){
      $valid = false;
    }
  }

if($valid == false){
//Alert err message
$arr = array('invalidInput'=>$password);
echo json_encode($arr);
}
else{
// Select from database
$q = "SELECT * FROM users WHERE passwords ='$password' AND receivedLoan=0";
$q_output = mysqli_query($conn,$q);
$count = mysqli_num_rows($q_output);

if($count < 0){
//Alert err message
$arr = array('denied'=>$fail);
echo json_encode($arr);
}

else{
//Get contribution sum and evaluate amount to be loaned out
$evaluate = "SELECT SUM(contribution) AS mySum FROM contributes WHERE ids='$userID'";
$evaluateQuery = mysqli_query($conn,$evaluate);
if(mysqli_num_rows($evaluateQuery) > 0){
  while($var = mysqli_fetch_assoc($evaluateQuery)){
    $TotalContribution = $var['mySum'];
  }
}
$TotalContribution_90 = $TotalContribution * 90/100;
//then we provide loan that is not higher than 90% of total contributon
if($amount > $TotalContribution_90){
  //Alert arr message
$arr = array('toomuch'=>$TotalContribution);
echo json_encode($arr);
}
else{
  //Insert loan in database + 2 
  $amount_20 = $amount + $amount * 5/100;
  $update = "UPDATE users SET receivedLoan = '$amount_20' WHERE passwords='$password'";
  $update_query = mysqli_query($conn,$update);
  //Alert arr message
$arr = array('granted'=>$pass,'fname'=>$fname,'mname'=>$mname,'sname'=>$sname,
'cno'=>$phone,'money'=>$amount);

echo json_encode($arr);
}
}
}
?>
