<?php
$conn = mysqli_connect("localhost", "admin", "admin", "forum");

$errors = "";

session_start();
if(is_null($_SESSION["username"])){
    header("Location: login.php");
}

    $title = $_GET["title"];
    if(is_null($title)){
        header("Location: index.php");
    }
    $isuser= mysqli_query($conn, "SELECT poster from forum.posts where post_title='$title'");
    $data = mysqli_fetch_assoc($isuser);
    if($_SESSION["username"]== $data["poster"])
    {
        $query = mysqli_query($conn, "DELETE FROM forum.posts WHERE post_title='$title';");
    }
    else{
    $errors = "You can't delete another user's post";
    }
    if(!is_null($query)){
    $errors = "Post deleted successfully";
    $query = mysqli_query($conn, "DELETE FROM forum.replies WHERE post_title='$title';");
    }

?>
<!DOCTYPE HTML>
<html><body bgcolor=" #aeb6bf ">
    <h1><a href="index.php">> Go Back <</a></h1>
<h2> <?php echo "$errors"; ?></h2></body>
</html>