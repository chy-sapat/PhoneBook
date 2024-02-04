<?php
    include("db.php");
    session_start();
    //Initial state of error
    $error = "false"; //No error initially
    $errorMsg = ""; //No error msg to show
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        //fetch user data
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();

        //check if record exist in DB
        if($data){
            //check if password matches
            if (password_verify($password, $data["password"])){
                $_SESSION["userId"] = $data["id"];
                header("location:contacts.php");
                exit();
            } else { //paddword doesn't match
                $error = "true";
                $errorMsg = "Incorrect Password";
            }
        } else { //no record exist in DB
            $error = "true";
            $errorMsg = "User Not Found";
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
        <!--Login Form-->
        <form method="post">
            <h2>Log In</h2>
            <p class="error-msg" aria-expanded="<?php echo $error ?>"><?php echo $errorMsg; ?></p>
            <div class="form-group">
                <label for="username">Username </label>
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
            <button type="submit">Log In</button>
            <p>Don't Have An Account? <a href="register.php">Register</a></p>
        </form>
    </div>

    <!-- Scripts -->
    <script src="script.js"></script>
</body>

</html>