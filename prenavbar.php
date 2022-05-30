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
    <header>
        <div class="logo">Time Tracking App</div>
        <div>
            
        <?php
            if(isset($_SESSION["userName"])){
                echo
                "<ul class='authBntsCnt'>
                    <li class='authBnts'>
                       <a href='#'>".$_SESSION["userName"]."</a>
                    </li>
                    <li class='authBnts'>
                       <a href='logout.php'>Logout</a>
                    </li>
                </ul>";
            }
            else{
                echo "
            <ul class='authBntsCnt'>
                <li class='authBnts'><a href='login.php'>Log In</a></li>
                <li class='authBnts'><a href='signup.php'>Sign Up</a></li>
            </ul>";
            }
            ?>
            
        </div>
    </header>
</body>
</html>