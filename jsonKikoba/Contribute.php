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

            //Insert user contribution in db
            $insert = "INSERT INTO contributes(ids,contribution) VALUES('$id','$amount')";
            mysqli_query($dbconn,$insert);

            // get sum of all contributions of this user
            $evaluate = "SELECT SUM(contribution) AS mySum FROM contributes WHERE ids='$id'";
            $evaluateQuery = mysqli_query($dbconn,$evaluate);
            if(mysqli_num_rows($evaluateQuery) > 0){
              while($var = mysqli_fetch_assoc($evaluateQuery)){
                $TotalContribution = $var['mySum'];
              }
            }
            $totalContribution = $TotalContribution;
            if($totalContribution == null){
                $totalContribution = "You haven't contributed anything";
            }            
            
            //return response to user 
            $response = array( 'status' => 'success',
            'money'=>$totalContribution,
            'fname'=>$fname,
            'mname'=>$mname,
            'sname'=>$sname
            );  
            
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
