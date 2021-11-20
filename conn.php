<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "quanlynhanvien";

    $conn = mysqli_connect($host, $username, $password, $database);
    if(!$conn){
        die("Could not connect to database");
    }
?>