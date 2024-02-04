<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION["userId"])){
        header("location:login.php");
    }
    $userid = $_SESSION["userId"];
    //fetch user info
    $sql = "SELECT username FROM users WHERE id='$userid'";
    $result = $conn->query($sql);
    $userData = $result->fetch_assoc();
    // fetch contacts 
    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhoneBook</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <h1 class="logo-secondary">Phonebook</h1>
        <div class="user-profile">
            <span><?php echo $userData["username"] ?></span>
            <a class="add-contact-btn" href=" addContact.php">Add Contact</a>
            <a class="logout-btn" href="logout.php">Log Out</a>
        </div>
    </nav>
    <main>
        <h2 class="heading">Contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result->num_rows > 0) {?>
                <?php while($data = $result->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $data["name"];?></td>
                    <td><?php echo "+977 ".$data["contact"];?></td>
                    <td>
                        <?php if($userid == $data["user_id"]) {?>
                        <a href="editContact.php?id=<?php echo $data["id"] ?>">Edit</a>
                        <a class="delete-btn" href="deleteContact.php?id=<?php echo $data["id"] ?>">Delete</a>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
                <?php } else { ?>
                <tr>
                    <td colspan="3"> No Contacts Added</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>

<?php $conn->close(); ?>