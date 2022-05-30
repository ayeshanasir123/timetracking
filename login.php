<?php
    SESSION_START();
    require_once "connect.php";
    // Input Validation
    function validateInput($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    $email=$password="";
    $loginErr=$emailErr1=$passwordErr1="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=validateInput($_POST["email"]);
    $password=validateInput($_POST["password"]);
    if(empty($email)){
        $emailErr1="*Please enter your email*";
    }
    if(empty($password)){
        $passwordErr1="*Please enter your password*";
    }
    if(!empty($email) && !empty($password)){
        $fetchSql="SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$fetchSql);
        $row=mysqli_fetch_assoc($result);
        if($email!==$row['email'] || $password!==$row['password']){
            $loginErr="Login Credentials Doesn't Matched";
        }
        else if($email===$row['email'] && $password===$row['password']){
            $_SESSION["userName"]=$row["name"];
            $_SESSION["userid"]=$row["id"]; 
            header("Location:userHome.php");
        }
        // else if($email===$row['email'] && $row["email"]==="admin@gmail.com"){
        //     $_SESSION["userName"]=$row["name"];
        //     header("Location:admindashboard.php");
        // }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("prenavbar.php");
    ?>
    <main class="loginpagemainCnt">
        <?php
        if(isset($_SESSION["registered"])){
            echo "
             <span class='registrationSuccessAlert'>".$_SESSION["registered"]."</span>
             ";
        }
        else if(isset($_SESSION["notLogedin"])){
            echo "
            <span class='notLogedInCnt'>".$_SESSION["notLogedin"]."</span>";
        }
        ?>

        <div class="loginCnt">
            <h2>Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="loginFormCnt">
                <label for="email" class="loginLabel">Email</label>
                <input type="email" name="email" id="email" placeholder="@email...">
                <span class='errMsg'><?php echo $emailErr1; ?></span>
                <label for="password" class="loginLabel">Password</label>
                <input type="password" name="password" id="password" placeholder="password...">
                <span class='errMsg'><?php echo $passwordErr1; ?></span>
                <?php
                if($loginErr!==""){
                    echo 
                "<span class='loginErrMsg'>$loginErr;</span>";
                }
                ?>
                <input type="submit" name="login" id="login" value="Login" class="loginPagBtn">
            </form>
        </div>
    </main>
    <?php
        UNSET($_SESSION["registered"]);
include("footer.php");
?>
    
</body>
</html>