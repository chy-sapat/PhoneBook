<?php
    include("db.php");
    session_start();

    $contactId = $_GET["id"];
    $sql = "DELETE FROM contacts WHERE id='$contactId'";
    $conn->query($sql);
    $conn->close();
    header("location:contacts.php");
    exit();
?>