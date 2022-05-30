<?php
    SESSION_START();
    require_once "connect.php";
    $username=$gender=$email=$password=$cPassword="";
    $usernameErr=$genderErr=$emailErr=$emailInvalidEr=$passwordErr=$cpasswordErr=$emailExistErr="";
    $fetchSql="SELECT * FROM users";
        $fetchedResult=mysqli_query($conn,$fetchSql);
        $fetchedRow=mysqli_fetch_assoc($fetchedResult);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=validateInput($_POST["username"]);
        $gender=validateInput($_POST["gender"]);
        $email=validateInput($_POST["email"]);
        $password=validateInput($_POST["password"]);
        $cpassword=validateInput($_POST["cpassword"]);
        //check username is empty
        if(empty(trim($username))){
            $usernameErr="*Username cannot be empty*";
        }
        
        if(empty(trim($gender))){
            $genderErr="*Please sellect your gender*";
        }
        if(empty(trim($email))){
            $emailErr="*Please enter your email*";
        }
        
        if(empty(trim($password))){
            $passwordErr="*Please fill out password*";
        }
        if(empty(trim($cpassword))){
            $cpasswordErr="*
            please fill out password*";
        }
        if($password!==$cpassword){
            $cpasswordErr="*Your password does not match*";
        }
        if($email===$fetchedRow["email"]){
            $emailExistErr="This email is already registered, try using another email";
        }
    }
        if($email!==$fetchedRow["email"] && !empty(trim($username)) && !empty(trim($gender)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($cpassword)) && $password===$cpassword){
            $sql="INSERT INTO users(name,gender,email,password,registerDate) VALUES('$username','$gender','$email','$password',NOW())";
            $result=mysqli_query($conn,$sql);
            if($result==true){
                $_SESSION["registered"]="Registration Successful";
            header("Location:login.php");
            }
            else{
                header("Location:signup.php");
            }
        }
    
    function validateInput($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("prenavbar.php");
    ?>
    <main class="signupMainCnt"> 

        <div class="signupHeading">
            <h1>Sigup</h1>
            <?php
            if($emailExistErr!==""){
                echo
            "<span class='emailExistErrCnt'>".$emailExistErr."</span>";
            }
            ?>
        </div>
        <div class="signupCnt">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="signupForm">
                <label for="username">Name</label>
                <input type="text" name="username" id="username" placeholder="Enter your name...">
                <span class="errMsg"><?php echo $usernameErr; ?></span>
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option>Choose your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    
                </select>
                <span class="errMsg"><?php echo $genderErr; ?></span>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your @email...">
                <span class='errMsg'><?php echo $emailErr; ?></span>
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password...">
                <span class="errMsg"><?php echo $passwordErr; ?></span>
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password...">
                <span class="errMsg"><?php echo $cpasswordErr; ?></span>
                <button type="submit" name="signup" value="Signup" class="signupBtn">Signup</button>
            </form>
        </div>
    </main>
    <?php
        include("footer.php");

?>
</body>
</html>