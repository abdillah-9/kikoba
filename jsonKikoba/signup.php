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
        $uname = $data->fullName;
        $email = $data->email;
        $pword = $data->pword;
        $fname = $data->fname;
        $mname = $data->mname;
        $sname = $data->sname;
        $age = $data->age;
        $phone = $data->phone;

        // Validate JSON data (basic validation)
        if (isset($data->fullName) && isset($data->email)) {
            // Perform further processing (e.g., save to database)
            $dbconn = mysqli_connect("localhost", "root", "", "kikoba");
            $select ="SELECT * FROM users WHERE username='$uname' and emails='$email' and passwords='$pword'";
            $checkedUser = mysqli_query($dbconn, $select);
            $count = mysqli_num_rows($checkedUser);
            
            if($count < 1){
              //return normal user success response
              //But dont forget to save these details of new user to database
              $insert = "INSERT INTO users(category,username,passwords,emails,fname,mname,sname,age,phone,receivedLoan)
              VALUES('Normal','$uname','$pword','$email','$fname','$mname','$sname','$age','$phone',0)";
              $insert_output = mysqli_query($dbconn,$insert);
              $response = array("status" => "success", "message" => "Thank you, $data->fullName, for signing up!");  
            }
            else{
              //return normal user denied response
              $response = array("status" => "denied", "message" => "Sorry, $data->fullName, this account exists!");             
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
