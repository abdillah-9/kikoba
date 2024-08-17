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

$query = "SELECT * FROM users WHERE id ='$id' AND receivedLoan!=0";
$query_output = mysqli_query($dbconn,$query);
$count = mysqli_num_rows($query_output);

if($count < 1){
//Alert err message
$response = array('status'=>'denied','message' => 'You do not have loan debt');

}

else{
      //Get loaned amount and put it in num variable
      while($num = mysqli_fetch_assoc($query_output)){
        $loanedAmount = $num["receivedLoan"];
    }
    $loanedAmountM = $loanedAmount;
    //Alert user based on response
    if($loanedAmountM < $amount){
        //Alert arr message
        $response = array('status'=>'toomuch','message' => 'The amount is higher than your loan debt');

    }
    else{
        //Update debt in database 
        $diff = $loanedAmountM - $amount;
        $update = "UPDATE users SET receivedLoan = '$diff' WHERE id='$id'";
        $update_query = mysqli_query($dbconn,$update);

        //Alert err message
        $response = array('status'=>'success','fname'=>$fname,
        'mname'=>$mname,'sname'=>$sname, 'amountRemain' => $diff);
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
