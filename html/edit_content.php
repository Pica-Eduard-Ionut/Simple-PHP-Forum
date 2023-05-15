<?php
$conn = mysqli_connect("localhost", "admin", "admin", "forum");
$errors = "";

session_start();
if (is_null($_SESSION["username"])) {
    header("Location: login.php");
}

$title = $_GET["title"];
if (is_null($title)) {
    header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION["username"];
    $isuser = mysqli_query($conn, "SELECT post_title, post_description, poster from forum.posts where poster='$user'");
    $data = mysqli_fetch_assoc($isuser);
    $desc = htmlspecialchars($_POST["desc"]);
    $title = $data["post_title"];
    if ($_SESSION["username"] == $data["poster"]) {
        $query = mysqli_query($conn, "UPDATE forum.posts SET post_description = '$desc' WHERE post_title='$title';");

    } else {
        $errors = "You cannot modify another user's post";
    }
    if (!is_null($query)) {
        $errors = "Post edited successfully";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Creating posts</title>
</head>

<body bgcolor=" #aeb6bf ">
    <h1><a href="index.php">> Go Back <</a><br> Modify a current post</h1>
    <p style="color: red;">
        <?php echo $errors; ?>
    </p>
    <?php
    $query = mysqli_query($conn, "SELECT post_title, post_description, poster from forum.posts where post_title='$title'");
    $data = mysqli_fetch_assoc($query);

    echo "Previous description:  <b>" . $data["post_description"] . "</b>"

        ?>
    <br><br>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <textarea name="desc" rows="25" cols="50" placeholder="Post description"></textarea><br><br>
        <input type="submit" name="update" value="Update post">
    </form>
</body>

</html>