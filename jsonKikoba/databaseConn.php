<?php
$server_name = "localhost";
$user_name = "root";
$pass_word = "";
$db_name ="kikoba";
//Create conn
$conn = new mysqli($server_name,$user_name,$pass_word,$db_name);
//echo "Conn successful";

/*//Create user table
$userTable = "CREATE TABLE users(
    id int(3) UNSIGNED AUTO_INCREMENT NOT NULL,
    category varchar(10) NOT NULL,
    username varchar(20) NOT NULL,
    passwords varchar(20) NOT NULL,
    emails varchar(30) NOT NULL,
    fname varchar(20) NOT NULL,
    mname varchar(20) NOT NULL,
    sname varchar(20) NOT NULL,
    age varchar(3) NOT NULL,
    phone varchar(10) NOT NULL,
    receivedLoan int(10) NOT NULL,
    duration TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
    )";
    mysqli_query($conn,$userTable);
    echo "user table created";

//Create user table
$contributionTable = "CREATE TABLE contributes(
    id int(3) UNSIGNED AUTO_INCREMENT NOT NULL,
    ids int(3) UNSIGNED,
    contribution int(10) NOT NULL,
    duration TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (ids) REFERENCES users(id) ON DELETE CASCADE
    )";  
    if(mysqli_query($conn,$contributionTable)){
       echo "contribution table created";
    }

//nsert admn  in db
$insert = "INSERT INTO users(id,category,username,passwords,emails,fname,mname,sname,age,phone) 
VALUES(1,'Admin','Admin','Admin','admin1@gmail.com','Admin','Admin','Admin',21,0987654321)";
mysqli_query($conn,$insert);
echo "data inserted";

//nsert chairman in db

$insert2 = "INSERT INTO users(id,category,username,passwords,emails,fname,mname,sname,age,phone) 
VALUES(2,'Leader','Chairman','Chairman','chairman2@gmail.com','Chairman','Chairman','Chairman',21,0987654321)";
mysqli_query($conn,$insert2);
echo "data inserted";*/

//Join tables
$joint = "SELECT * FROM users INNER JOIN contributes ON users.id = contributes.ids";
if(mysqli_query($conn,$joint)){
  //  echo "Connection is done";
}
?>