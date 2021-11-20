<?php 
    session_start();
    if(!$_SESSION["username"]){
        header("Location: login.php");
    }else if($_SESSION["username"] == "admin"){
        header("Location: admin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    <!--Fontawesome CDN-->

    <style>
        .nav-item a{
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    <?php
        require_once("conn.php");
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
    ?>
    
    <nav class="navbar navbar-expand-sm navbar-dark  bg-dark p-3">
        <a class="navbar-brand" href="index.php">Trang Nhân Viên</a>
        <!-- Right -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-5 align-items-center">
                <a href="update.php"><?= $row["name"]?></a>
            </li>
            <li class="nav-item mr-5 align-items-center">
                <img src="<?= $row["image"]?>" style="max-width: 50px;" alt="Ảnh đại diện">
            </li>
            <li class="nav-item mr-5 align-items-center">
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <h3>Chào mừng trở lại <strong style="color: red;"><?= $row["name"]?></strong>:333333</h3>
    
    
</body>
</html>