<?php
    SESSION_START();
    include("connect.php");
    if(isset($_SESSION["userName"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Tracking App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("prenavbar.php");
    ?>
    <main class="homeMainCnt">
        <h2>Welcome To Time Tracking App</h2>
        <div class="homeCnt1Inner">
            <a href="addnewtask.php">Add new Task</a>
            <a href="viewtasks.php">View existing tasks</a>
        </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
</html>
<?php
    }
    else{
        $_SESSION["notLogedin"]="You're not Login, Please Login To Proceed";
        header("Location:login.php");
    }
?>