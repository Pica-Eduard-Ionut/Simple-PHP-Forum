<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "admin", "admin", "forum");

    $errors = "";
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($username) or empty($email) or empty($password) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors = "Invalid input!";
    } else {
        $query = mysqli_query($conn, "SELECT username, email FROM forum.users WHERE username='$username';");
        $data = mysqli_fetch_assoc($query);

        if (!is_null($data["username"])) {
            $errors = "Username already exists!";
        } elseif (!is_null($data["email"])) {
            $errors = "E-mail already exists!";
        } else {
            $query = mysqli_query($conn, "INSERT INTO forum.users (username, email, password) VALUES ('$username', '$email', '$password');");

            if ($query) {
                echo "User created!";
                header("Location: login.php");
            } else {
                echo "It's not working!";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title> Register Page </title>
</head>
<body bgcolor=" #aeb6bf ">
    <h1>Register page</h1>
    <p style="color: red"><?php echo $errors; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="text" name="email" placeholder="E-mail"><br>
        <input type="password" name="password" placeholder="Password"><br><br>

        <input type="submit" value="Register"> <a href="login.php">or Sign in</a>
</form>
</body>
</html>
