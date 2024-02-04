<?php
    $host = "127.0.0.1";
    $db = "phonebook";
    $user = "root";
    $password = "";
    $conn = new mysqli($host, $user, $password, $db);

    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
?>