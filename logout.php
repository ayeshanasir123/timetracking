<?php
    SESSION_START();
    unset($_SESSION["userName"]);
    session_destroy();
    header("Location:login.php");
?>