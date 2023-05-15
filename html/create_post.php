<?php
session_start();
if(is_null($_SESSION["username"])) {
    header("Location: login.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST" ){

    $conn = mysqli_connect("localhost", "admin", "admin", "forum");

    $errors = "";
    $poster = $_SESSION["username"];
    $title = htmlspecialchars($_POST["title"]);
    $post_desc = htmlspecialchars($_POST["desc"]);

    if(empty($title) or empty($post_desc)){
        $errors = "Invalid input!";
    } else {
        $query = mysqli_query($conn, "SELECT post_title FROM forum.posts WHERE post_title='$title';");
        $data = mysqli_fetch_assoc($query);

        if(!is_null($data["post_title"])){
            $errors = "Post name already exists!";
        } else {
            $query = mysqli_query($conn, "INSERT INTO forum.posts (poster, post_title, post_description) 
            VALUES ('$poster', '$title', '$post_desc');");
            
            if($query) {
                header("Location: index.php");
            } else{
                echo "It didn't work!";
            }
        }
    }

}
?>

<!DOCTYPE html>
<html>
    <head> <meta charset="utf-8">
    <title>Creating posts</title>
</head>
<body bgcolor=" #aeb6bf ">
<h1> Create a new post</h1>
<p style="color: red;"><?php echo $errors; ?> </p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="text" name="title" placeholder="Title"> <br><br>
    <textarea name="desc" rows="25" cols="50" placeholder="Post description"></textarea><br><br>
    <input type="submit" value="Submit post">
</form>

</body>
</html>