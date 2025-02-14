<?php
    $serverName = "localhost";
    $userName = "saifmk";
    $password = "data123";
    $dataBaseName = "investo_database";

    $connection = new mysqli($serverName , $userName , $password , $dataBaseName);

    if($connection -> connect_error){
        echo "connection failed";
    }
    else{
        echo "connection failed";
    }
?>

