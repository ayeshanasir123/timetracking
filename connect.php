<?php
    $server="localhost";
    $username="root";
    $password="";
    $database="timetrackingappdb";
    $conn=mysqli_connect($server,$username,$password,$database);
    if($conn==false){
        die('Connection To DB Failed');
    }
?>