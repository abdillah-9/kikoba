<?php
// Set headers to accept JSON
header("Content-Type: application/json");

// Handle POST request with JSON data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get raw JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Check if JSON data exists
    if ($json_data) {
        // Decode JSON data
        $data = json_decode($json_data);

        //Assign variables
        $id = $data->id2;
        $amount = $data->amount;

        // Validate JSON data (basic validation)
        if (isset($data->id2)) {
            // fetch user details based on id value
            $dbconn = mysqli_connect("localhost", "root", "", "kikoba");
            $obtainId = "SELECT * FROM users WHERE id='$id'";
            $obtainIdQuery = mysqli_query($dbconn,$obtainId);
            if(mysqli_num_rows($obtainIdQuery) > 0){
              while($myid = mysqli_fetch_assoc($obtainIdQuery)){
                $fname = $myid["fname"];
                $mname = $myid["mname"];
                $sname = $myid["sname"];
              }
            }

// Select from database
$q = "SELECT * FROM users WHERE id='$id' AND receivedLoan=0";
$q_output = mysqli_query($dbconn,$q);
$count = mysqli_num_rows($q_output);

if($count < 1){
//Alert err message
$response = array('status'=>'denied','message' => 'You have not paid previous loan debt');
}

else{
//Get contribution sum and evaluate amount to be loaned out
$evaluate = "SELECT SUM(contribution) AS mySum FROM contributes WHERE ids='$id'";
$evaluateQuery = mysqli_query($dbconn,$evaluate);
if(mysqli_num_rows($evaluateQuery) > 0){
  while($var = mysqli_fetch_assoc($evaluateQuery)){
    $TotalContribution = $var['mySum'];
  }
}
$TotalContribution_90 = $TotalContribution * 90/100;
//then we provide loan that is not higher than 90% of total contributon
if($amount > $TotalContribution_90){
  //Alert arr message
$response = array('status'=>'toomuch','message' => 'You cannot take loan more than 90% of your total contribution');
}
else{
  //Insert loan in database + 2 
  $amount_20 = $amount + $amount * 5/100;
  $update = "UPDATE users SET receivedLoan = '$amount_20' WHERE id='$id'";
  $update_query = mysqli_query($dbconn,$update);
  //Alert arr message
$response = array('status'=>'success','fname'=>$fname,
'mname'=>$mname,'sname'=>$sname);
}
}
            
        } else {
            $response = array("status" => "error", "message" => "Invalid JSON data format.");
        }
    } else {
        $response = array("status" => "error", "message" => "No JSON data received.");
    }
} else {
    $response = array("status" => "error", "message" => "Invalid request method.");
}

// Send JSON response
echo json_encode($response);
?>
