<?php

include("connection.php");

// echo "connected <br>" ;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])){

$firstName = $_POST["first-name"];
$lastName = $_POST["last-name"];
$userEmail = $_POST["user-email"];
$userPassword = $_POST["user-password"];

// hashing the password for protection
$password = password_hash($userPassword , PASSWORD_BCRYPT);



// sending the data into the database
// if(!empty($firstName) && !empty($lastName) && !empty($userEmail) && !empty($password)){
    
$sql = "INSERT INTO user_details (FIRST_NAME , LAST_NAME , USER_EMAIL , USER_PASSWORD) VALUES ('$firstName' , '$lastName' , '$userEmail' , '$password')";

mysqli_query($connection , $sql);

echo "<script>
                alert('REGISTRATION SUCCESSFUL, NAVIGATING TO LOGIN PAGE');
                window.location.href = 'login.html';
            </script>";


}
else{
    // echo "not ok";
    // echo "<script>
    //             alert('Error: " . mysqli_error($connection) . "');
    //             window.history.back();
    //         </script>";
}

mysqli_close($connection);
// }
// else{
//     // echo "enter the value";
// }




$sqlSearch = "SELECT  USER_EMAIL FROM user_details";
$result = mysqli_query($connection , $sqlSearch);


if($result){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo $row['USER_EMAIL'] . "<br>";
        }
    }
    else{
        echo "no emails where found";
    }
}
else{
    echo mysqli_error($connection);
}

mysqli_close($connection);

?>
