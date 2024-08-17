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

        // Validate JSON data (basic validation)
        if (isset($data->fullName) && isset($data->email)) {
            // Perform further processing (e.g., save to database)
            $dbconn = mysqli_connect("localhost", "root", "", "kikoba");
            $select ="SELECT * FROM users WHERE username='$uname' and emails='$email' and passwords='$pword'";
            $checkedUser = mysqli_query($dbconn, $select);
            $count = mysqli_num_rows($checkedUser);
            
            if($uname =="Admins" && $email =="admin1@gmail.com" && $pword == "Admins"){
              //return admin response
              $response = array("status" => "successAdmin", "message" => "Thank you, $data->fullName, for signing in!");  
            }
            elseif($count > 0){
              //return normal user success response
              //select user id
              if(mysqli_num_rows($checkedUser) > 0){
                while($row = mysqli_fetch_assoc($checkedUser)){
                  $id = $row['id'];
                  }
                }
              $response = array("status" => "success","id"=>"$id" , "message" => "Thank you, $data->fullName, for signing in!");  
            }
            else{
              //return normal user denied response
              $response = array("status" => "denied", "message" => "Sorry, $data->fullName, this account does not exist!");             
            }
            // For simplicity, just return a success message
            //$response = array("status" => "success", "message" => "Thank you, $data->fullName, for signing up!");
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
