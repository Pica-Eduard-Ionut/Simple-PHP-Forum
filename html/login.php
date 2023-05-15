<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = mysqli_connect("localhost", "admin", "admin", "forum");

    $errors = "";
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($username) or empty($password)) {
        $errors = "Invalid input!";
    } else {
        $query = mysqli_query($conn, "SELECT username, password FROM forum.users WHERE username='$username';");
        $data = mysqli_fetch_assoc($query);

        if (is_null($data["username"])) {
            $errors = "Username doesn't exist!";
        } else {
            if ($password == $data["password"]) {
                session_start();
                $_SESSION["username"] = $username;
                header("Location: index.php");
            } else {
                $errors = "Password is incorrect!";
            }
        }
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title> Login Page </title>
</head>
<body bgcolor=" #aeb6bf ">
<h1> Login Page </h1>
    <p style="color: red;"><?php echo $errors; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="submit" value="Log in"> <a href="register.php">or Register here</a>
</form>
</body>
</html>




    