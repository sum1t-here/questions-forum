<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Forum</title>
    <?php include("./client/commonFiles.php") ?>
</head>
<body>
    <?php
        session_start();

        include("./client/header.php");
        // checks if ?signup=true
        if(isset($_GET['signup']) && !$_SESSION["user"]["username"]){
            include("./client/signup.php");
        } else if(isset($_GET['login']) && !$_SESSION["user"]["username"]) {
            include("./client/login.php");
        } else if(isset($_GET["ask"]) && $_SESSION["user"]["username"]){
            include("./client/ask.php");
        } else if(isset($_GET['q-id'])) {
            $qid = $_GET['q-id'];
            include("./client/question-details.php");
        } else {
            include("./client/questions.php");
        }
    ?>
</body>
</html>