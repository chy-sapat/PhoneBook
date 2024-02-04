<?php
    include("db.php");
    session_start();
    $userid = $_SESSION["userId"];

    $error = "false";
    $errorMsg = "";

    $name = "";
    $phone = "";

    $phoneValidationRegex = "/^[0-9]{10}$/";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        
        if(preg_match($phoneValidationRegex, $phone)){
            $sql = "INSERT INTO contacts(user_id, name, contact) VALUES('$userid', '$name','$phone')";
            $conn->query($sql);
            header("location:contacts.php");
            exit();
        } else {
            $error = "true";
            $errorMsg = "Invalid Phone Number";
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phonebook</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form method="post">
            <h2>Add New Contact</h2>
            <p class="error-msg" aria-expanded="<?php echo $error ?>"><?php echo $errorMsg; ?></p>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
            </div>
            <button type="submit">Add</button>
            <p><a href="contacts.php">Back to contact</a></p>
        </form>
    </div>
</body>

</html>