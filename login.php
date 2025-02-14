<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_decor.css">
</head>
<body>
    <div class="login-image-parent">
        <img src="Login-image.svg" alt="oops image not found" class="login-image-decor">
    </div>

    <div class="login-text-parent">
        <h2 class="login-text-decor">
            WELCOME BACK
        </h2>
    </div>
<form action="login.php" method="post">
    <div class="email-pin-parent">
        <!-- ----------------- -->
        <div class="email-child">
            <h3 class="email-decor">
                Email ID
            </h3>
            <input type="email" class="input-decor" id="email_id" name="user-email">
            <p class="error-message" id="email-error-message"></p>
        </div>
        <!-- ----------------- -->
        <div class="pin-child">
            <h3 class="pin-decor">
                Password
            </h3>
           
                <input type="password"      class="pin-input-decor" id="pin_input_decor" maxlength="30" name="user-password" >
                <p class="pass-error-message" id="password-error-message"></p>

                <p id="pin-error-message"></p>
            

           
        </div>
        <!-- ----------------- -->

        <div class="login-button">
                <button class="login-button-decor" name="submit">
                    Login
                </button>
        </div>
</form>

        <div class="reset-pin">
            <a href="registration_page.html" class="reset-pin-decor">
                Request Pin Reset
            </a>
        </div>
    </div>
</body>
</html>


<?php

include("connection.php");

class credential{
    public $userEmail;
    public $userPass;
}

class credentialData extends credential{
    public function __construct(){
        $this->userEmail = $_POST["user-email"] ?? '';
        $this->userPass = $_POST["user-password"] ?? '';
    }
}

class sqlconnectioLogin extends credentialData{
    public function sqlQuery(){
        global $connection;

        // this is used to prevent the injection
        $userEmail = mysqli_real_escape_string($connection , $this->userEmail);
        $userPass = mysqli_real_escape_string($connection , $this->userPass);

       

            // this is the sql query to connect to the db and check if the email id is present in the db
            $query = "SELECT * FROM user_info WHERE USER_EMAIL =   '$userEmail'";
            $result = mysqli_query($connection , $query);
            $numOfRow = mysqli_num_rows($result);


            // this is the condition that checks if the email is found in the db
            if($numOfRow <= 0){

                // script used to print the error message in red
                echo "
                   <script>

                        let emailError = document.getElementById('email-error-message')
                        emailError.innerText = 'Email Not Found';

                        emailError.style.color = '#FD2626';
                    
                    </script>

                ";
            }

            else{
                

                while($row = mysqli_fetch_assoc($result)){
                    if($userPass == $row["USER_PASSWORD"]){
                        //using of the session for storing the table name of the user 
                        $_SESSION['table_name'] = $row["FIRST_NAME"] . $row["LAST_NAME"];

                        // js code of the display and logical part of front-end

                        echo"
                        
                        <script>
                            let passwordError = document.getElementById('password-error-message');
                        
                            passwordError.innerText = 'Authentication Successful';

                            passwordError.style.color = '#33FE00';

                            window.location.assign('home_page.html');

                        </script>
                
                        ";
                        break;
                    }
                    else{
                        // echo "password is incorrect";
                        
                        echo"
                        
                        <script>
                            let passwordError = document.getElementById('password-error-message');
                            passwordError.innerText = 'Authentication Failed';

                            passwordError.style.color = '#FD2626';
                        </script>
                
                        ";
                        break;
                    }
                }
            }
        mysqli_close($connection);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = new sqlconnectioLogin();
        $login->sqlQuery();
    }

?>

