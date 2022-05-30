 <?php
   SESSION_START();
   include("connect.php");
   if(isset($_SESSION['taskAdded'])){
  echo $_SESSION['taskAdded'];
   }
  $fetchTaskQuery="SELECT * FROM `tasks` WHERE id='{$_SESSION['userid']}'";
  $fetchedQueryResult=mysqli_query($conn,$fetchTaskQuery);
  if(mysqli_num_rows($fetchedQueryResult)>0){
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks | Time Tracking App</title>
</head>
<body>
    
        <main class="viewTaskPageMainCnt">
            <h1>My Tasks</h1>
            
            <div class="taskTableCnt">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Comments</th>
                            <th>Time (Minutes)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row=mysqli_fetch_assoc($fetchedQueryResult)) {
                            ?>
                        <tr>
                            <td><?php echo $row["title"]; ?></td>
                            <td><?php echo $row["comment"]; ?></td>
                            <td><?php echo $row["time"]; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="genreport.php" class="reportBtn">Generate Report</a>
            </div>
        </main>

    <?php
    include("footer.php");
    unset($_SESSION['taskAdded']);
   }
else if(mysqli_num_rows($fetchedQueryResult)<=0){
    echo "Sorry No Data Found";
}
?>
</body>
</html>