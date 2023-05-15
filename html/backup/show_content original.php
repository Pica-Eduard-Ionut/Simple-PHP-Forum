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
    <?php
    $conn = mysqli_connect("localhost", "admin", "admin", "forum");
    $title = $_GET["title"];
    if(is_null($title)){
        header("Location: forum.php");
    }
    $query = mysqli_query($conn, "SELECT poster, post_title, post_description FROM forum.posting WHERE post_title='$title';");
    $data = mysqli_fetch_assoc($query);
    echo "<h1>" . $data["post_title"] . "</h1>";
    echo "<sup>by <b>" . $data["poster"] . "</b></sup><br><br><hr><br>";
    echo "<p>".$data["post_description"]."</p>";
    ?>
    </body>
    </html>