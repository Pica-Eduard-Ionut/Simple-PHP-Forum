<?php
session_start();
if(is_null($_SESSION["username"])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
</head>
<body>
    <p>Welcome <b><?php echo $_SESSION["username"] ?></b></p>
    <a href="create_post.php">Create a new post</a><br><br><br>
    <?php
    $conn = mysqli_connect("localhost", "admin", "admin", "forum");
    $query = mysqli_query($conn, "SELECT post_title, poster FROM forum.posting ORDER BY id DESC;");
    #$query = mysqli_query($conn, "SELECT post_title, poster FROM forum.posting;");
    while($data = mysqli_fetch_assoc($query)){
        echo "<h1><a href='show_content.php?title=" . $data["post_title"] . "'>" . $data["post_title"] . "</a> <sub>by " . $data["poster"] . "</sub></h1><br><br>";
    }
    ?>
    </body>
    </html>