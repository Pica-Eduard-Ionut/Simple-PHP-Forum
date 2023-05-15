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
<body bgcolor=" #aeb6bf ">
    <p>User: <b><?php echo $_SESSION["username"] ?></b><a href="logout.php"><p style="text-align:left">Log Out</p></a></p>
    <a href="create_post.php">Create a new post</a><br><br><br>
    <?php
    $conn = mysqli_connect("localhost", "admin", "admin", "forum");
    $query = mysqli_query($conn, "SELECT post_title, poster FROM forum.posts ORDER BY id DESC;");
    #$query = mysqli_query($conn, "SELECT post_title, poster FROM forum.posting;");
    while($data = mysqli_fetch_assoc($query)){
        echo "<p><b><a href='show_content.php?title=" . $data["post_title"] . "'>" . $data["post_title"] . "</a></b> &nbsp&nbsp&nbsp&nbsp&nbsp <a href='delete_content.php?title=" . $data["post_title"] . "'> Delete </a> &nbsp&nbsp&nbsp&nbsp&nbsp <a href='edit_content.php?title=" . $data["post_title"] . "'> Edit </a></p><p style='text-align:right'>By: " . $data["poster"] . "</p><hr>";
    }
    ?>
    </body>
    </html>