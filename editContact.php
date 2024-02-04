<?php
    include("db.php");
    session_start();

    $contactId = $_GET["id"];
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = $_POST["name"];
        $phone = $_POST["phone"];
    
        $sql = "UPDATE contacts SET name='$name', contact='$phone' WHERE id='$contactId'";
        $conn->query($sql);
        header("location:contacts.php");
        exit();
    }

    $sql = "SELECT * FROM contacts WHERE id='$contactId'";
    $result = $conn->query($sql);
    $contactInfo = $result->fetch_assoc();
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
            <h2>Edit Contact</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $contactInfo["name"] ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input type="text" name="phone" id="phone" value="<?php echo $contactInfo["contact"] ?>">
            </div>
            <button type="submit">Save</button>
            <p><a href="contacts.php">Back to contact</a></p>
        </form>
    </div>
</body>

</html>

<?php $conn->close(); ?>