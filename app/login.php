<?php

$host="localhost";
$user="root";
$password="grefferson";
$db="demo";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


if ( isset($_POST['email'], $_POST['password']) ) {


        $email=$_POST['email'];
        $password=$_POST['password'];
        echo "email: $email";
        echo "password: $password";
        

        $sql="select * from loginform where user='".$email."'AND pass='".$password."' limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            echo " You Have Successfully Logged in\n";
            header("Location: http://localhost/signindemo/app/product.php");
            exit();
        }  else {
            $sql2="select * from loginform where user='".$email."' limit 1";
            $result2 = $conn->query($sql2);
    
            if ($result2->num_rows > 0){
                echo "You have Entered Incorrect Password\n";
                exit();
            } else {
                // Redirect to registration page and show modal to user
                echo "User with the email " .$email. "does not exists\n";
            }
        }    

    }

exit();

if(isset( $_POST['submit'] )) {
    // your complete rest php code goes here to insert the record
}


?>
