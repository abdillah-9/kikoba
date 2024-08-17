<?php
include "databaseConn.php";

header('Content-Type: application/json');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

//Get sum of contributions
$evaluate = "SELECT SUM(contribution) AS mySum FROM contributes ";
$evaluateQuery = mysqli_query($conn,$evaluate);
if(mysqli_num_rows($evaluateQuery) > 0){
  while($var = mysqli_fetch_assoc($evaluateQuery)){
    $TotalContribution = $var['mySum'];
  }
}
$totalContribution = $TotalContribution;

//GET SUM OF LOANED AMOUNT
$loaned = "SELECT SUM(receivedLoan) AS mySum2 FROM users ";
$loanedQuery = mysqli_query($conn,$loaned);
if(mysqli_num_rows($loanedQuery) > 0){
  while($var = mysqli_fetch_assoc($loanedQuery)){
    $TotalLoaned = $var['mySum2'];
  }
}
$totalLoaned = $TotalLoaned;
//set value to be displayed
$arr = array('totalLoaned'=>$totalLoaned,'totalContribution'=>$totalContribution);
echo json_encode($arr);
?>
