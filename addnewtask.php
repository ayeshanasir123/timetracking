<?php
SESSION_START();

include("connect.php");
if(isset($_SESSION["userName"])){
    $userId=$title=$comment=$time="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
    $userId=$_SESSION["userid"];
    $title=$_POST["title"];
    $comment=$_POST["comment"];
    $time=$_POST["time"];
    $adTaskQuery="INSERT INTO `tasks` (`id`, `title`, `comment`, `time`) VALUES ('$userId', '$title', '$comment', '$time')";
    $taskAdResult=mysqli_query($conn,$adTaskQuery);
    if($taskAdResult){
        header("Location:viewtasks.php");
        $_SESSION['userId']=$_SESSION["userid"];
        $_SESSION['taskAdded']="Task Added Successfully";
    }   
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Task | Time Tracking App</title>
</head>
<body>
<?php
   include("prenavbar.php");
//    $_SESSION["id"];
?>
        <main class="adtaskMainCnt">
            <div class="adTaskFormCnt">
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" class="adTaskForm"> 
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Title...">
                    <label for="comment">Comment</label>
                    <input type="text" name="comment" id="comment" placeholder="Comment...">
                    <label for="time">Time To Complete Task</label>
                    <input type="text" name="time" id="time" placeholder="Time in minutes...">
                    <input type="submit" name="submit" class="AdTaskSubmitBtn">
                </form>
            </div>
        </main>

<?php
include("footer.php");
}
else{
    header("Location:login.php");
}
?>
</body>
</html>