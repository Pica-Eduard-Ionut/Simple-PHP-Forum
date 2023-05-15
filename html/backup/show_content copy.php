<?php
session_start();
if(is_null($_SESSION["username"])){
    header("Location: login.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = mysqli_connect("localhost", "admin", "admin", "forum");
    $poster = $_SESSION["username"];
    $reply = htmlspecialchars($_POST["reply"]);
    $title = htmlspecialchars($_POST["posttitle"]);
    if (empty($reply)) {
        $errors = "Invalid input!";
    }else{
            $query = mysqli_query($conn, "INSERT INTO forum.replies (poster, reply, post_title) VALUES ('$poster', '$reply', '$title');");
            if($query) {
                header("Location: .");
            } else{
                echo "It didn't work!";
            }
        }
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
        header("Location: index.php");
    }
    $query = mysqli_query($conn, "SELECT poster, post_title, post_description FROM forum.posts WHERE post_title='$title';");
    $data = mysqli_fetch_assoc($query);
    echo "<a href='index.php'>-->Go Back</a><center><h1>" . $data["post_title"] . "</h1></center>";
    echo "<sup>by <b>" . $data["poster"] . "</b></sup><hr>";
    echo "<p>&nbsp&nbsp&nbsp&nbsp&nbsp".$data["post_description"]."</p>";
    echo "<br>";
    echo "<hr><h2>Replies:</h2>";
    $query2 = mysqli_query($conn, "SELECT poster, post_title, reply FROM forum.replies WHERE post_title='$title';");
    while ($data = mysqli_fetch_assoc($query2)) {
         echo " <b>" . $data["poster"] . ":</b> " . $data["reply"] . "<hr>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <center><textarea name="reply" rows="3" cols="75" placeholder="Your reply"></textarea><br><br>
    <input type="text" name="posttitle" placeholder="Post's name">
    <input type="submit" value="Submit reply"></center>
</form>
    </body>
    </html>