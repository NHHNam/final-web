<?php
    session_start();
    require_once("conn.php");
    $loi = "";
    $username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        .nav-item a{
            text-decoration: none;
            color: white;
        }
        a{
            text-decoration: none;
        }
        a i{
            margin-bottom: 30px;
            font-size: 25px;
            color: #fff;
            background-color: red;
            padding: 10px;
            border: 1px solid black;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark  bg-dark p-3">
        <a class="navbar-brand" href="index.php">Trang Đổi Mật Khẩu</a>
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
    <a href="index.php"><i class="fas fa-arrow-left ml-5 mt-5 p-1"></i></a>
    <?php 
        require_once("conn.php");
        $sql1 = "SELECT * FROM user WHERE username = '$username'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $pwd = $row1['password'];
        $oldpwd = "";
        $newpwd = "";
        $confpwd = "";
        if(isset($_POST['update'])){
            $oldpwd = $_POST['oldpwd'];
            $newpwd = $_POST['npassword'];
            $confpwd = $_POST['cpassword'];
            $loi = "";
            if($oldpwd == $pwd){
                if($newpwd == ""|| $confpwd == ""){
                    $loi = "Please enter new paswword or confirm password";
                }else if($newpwd == $confpwd){
                    require_once("conn.php");
                    $sql2 = "UPDATE user SET password = '".$newpwd."' WHERE username = '".$username."' ";
                    $result2 = $conn->query($sql2);
                    $conn->close();
                    $loi = "updated successfully";
                }else{
                    $loi = "password is not match";
                }
            }else if($oldpwd == ""){
                $loi = "Please enter your old password";
            }else{
                $loi = "Password is not true Please enter again";
            }
        }
    ?>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form novalidate method="post" action="#">
                            <header>Update Form</header>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" id="oldpwd" name="oldpwd" class="form-control" placeholder="enter your password" value="<?php if($oldpwd) echo $oldpwd; ?>" required> 
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" id="npassword" name="npassword" class="form-control" value="<?php if($newpwd) echo $newpwd; ?>" placeholder="new password" required> 
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" id="cpassword" name="cpassword" value="<?php if($confpwd) echo $confpwd; ?>" class="form-control" placeholder="re-password" required>
                            </div>
                            <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                                <?php
                                    if($loi){
                                        echo $loi;
                                    }
                                ?>
                            </p>
                            <div class="form-group">
                                <input type="submit" name="update" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>