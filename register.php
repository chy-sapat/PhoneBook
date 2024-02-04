<?php
    include("db.php");

    $error = "false";
    $errorMsg = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();

        if($data){
            $error = "true";
            $errorMsg = "Username $username already taken";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(username, password) VALUES ('$username', '$hashedPassword')";
            $conn->query($sql);
            header("location:login.php");
            exit();
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
        <h1 class="logo">PhoneBook</h1>
        <form method="post">
            <h2>Register</h2>
            <p class="error-msg" aria-expanded="<?php echo $error ?>"><?php echo $errorMsg; ?></p>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="show-hide-password">
                <input type="checkbox" name="passVisibility" id="passVisibility">
                <label for="passVisibility" id="showPasswordLabel"></label>
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Log in</a></p>
        </form>
    </div>
    <script src="script.js">
    </script>
</body>

</html>