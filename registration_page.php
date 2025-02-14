<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Yourself</title>
    <link rel="stylesheet" href="reg_page.css">
</head>
<body>
    <div class="piggybank">
        <img src="investment.svg" alt="oops image not found" class="piggybank_image_decor">
    </div>

    <div class="registration_text">
        <h3 class="reg_text_decor">Make your progress right from here</h3>
    </div>

    <!-- <div class="details_section_parent"> -->
        <form action="registration_page.php" method="post" class="details_sections" onsubmit="register(event)" >
            
            <input type="text" placeholder="FIRST NAME" class="details_decor" name="first-name" required>
            <input type="text" placeholder="LAST NAME" class="details_decor" name="last-name" required>
            <input type="text" placeholder="EMAIL ID" class="details_decor" name="user-email" required>
            <input type="password" placeholder="PASSWORD" class="details_decor" name="user-password" required maxlength="30">

    <!-- </div> -->

    <div class="register_button">
        <button class="register_button_decor" name="submit">Register</button>
    </div>

    </form>
</body>
</html>

<!-- the php logic for the backend has been added over here... -->

<?php
session_start();
include("connection.php");

// class used to store all the credential of the user data
class credential {
    public $firstName;
    public $lastName;
    public $userEmail;
    public $userPassword;
    public $hashedPassword;

}

// inherited class using constructor for the entry of data using method post
class credentialData extends credential {
    public function __construct() {
        $this->firstName = $_POST["first-name"] ?? '';
        $this->lastName = $_POST["last-name"] ?? '';
        $this->userEmail = $_POST["user-email"] ?? '';
        $this->userPassword = $_POST["user-password"] ?? '';
        // $this->hashedPassword = password_hash($this->userPassword, PASSWORD_DEFAULT);
    }
}


// inherited class holding the entry of data and prevention of sql injections ,, contains the sql query for the addition of user account to the DB ,, contians sql query to create a new table when a user account is created
class sqlConnection extends credentialData {
    public function sqlQuery() {
        global $connection; // Assuming $connection is defined elsewhere
        global $continue;   // Assuming $continue is defined elsewhere

        $firstName = mysqli_real_escape_string($connection, $this->firstName);
        $lastName = mysqli_real_escape_string($connection, $this->lastName);
        $userEmail = mysqli_real_escape_string($connection, $this->userEmail);
        $userPassword = mysqli_real_escape_string($connection, $this->userPassword);

        $sqlSearch = "SELECT USER_EMAIL FROM user_info WHERE USER_EMAIL = '$userEmail'";
        $result = mysqli_query($connection, $sqlSearch);

        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists. Redirecting to login page.";
            echo "<script>
                alert('An account exists with this email, redirecting to login page.');
                window.location.href = 'login.php';
            </script>";
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
                // SQL query to insert user data into the database
                $sql = "INSERT INTO user_info (FIRST_NAME, LAST_NAME, USER_EMAIL, USER_PASSWORD) VALUES ('$firstName', '$lastName', '$userEmail', '$userPassword')";

                $continue = 0;
                

                if (mysqli_query($connection, $sql)) {
                    $continue = 1; 
        
                    echo "<script>
                        alert('Registration successful. Redirecting to login page.');
                        window.location.href = 'login.php';
                    </script>";

                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
            }
        }

        if ($continue == 1) {

            $name = $firstName . $lastName;
            
            // SQL query to create a new table for each user
            $sqlUserTable = "CREATE TABLE $name (
                
                purchaseStockName VARCHAR(50), 
                purchaseDate DATE, 
                buyingPrice INT, 
                buyingQuantity INT, 
                sellingStauts VARCHAR(20)
                -- sellingStockName VARCHAR(50), 
                -- sellingDate DATE, 
                -- sellingPrice INT, 
                -- sellingQuantity INT 
            )";

            // Execute the create table query
            if (mysqli_query($connection, $sqlUserTable)) {
                
                // this is the are in which the table name needs to be specified to the session
                $_SESSION['table_name'] = $name;

                echo "User table created successfully.";
            } else {
                echo "Error creating user table: " . mysqli_error($connection);
            }
        }

        mysqli_close($connection);
    }
}

$sqlDataConnected = new sqlConnection();
$sqlDataConnected->sqlQuery();
?>
