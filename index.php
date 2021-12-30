<?php

    session_start();
    require_once('db.php');
    if(!$_SESSION['username']){
        header("Location: login.php");
    }
    $username = $_SESSION["username"];
    $result = get_info_nhanvien($username);
    if($result['code'] == 0){
        $data = $result['data'];
    }
    if($data['status'] == 0){
        header("Location: updatePassword.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang nhân viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .nav-item .dropdown{
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle .dropdown-menu{
            max-width: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-info justify-content-between">
        <div class="nav-item">
            <h1 class="nav-link">Trang nhân viên</h1>
        </div>

        <div class="nav-item">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $data['image'] ?>" alt="Hinh dai dien" style="max-width: 40px;">
                </button>
                <div class="dropdown-menu">
                    <?php
                    if(check_truong_phong($data['name'], $data['maPB']) == true){
                        ?>
                            <a class="dropdown-item" href="api/truongphong.php">Trưởng phòng</a>
                            <a class="dropdown-item" href="api/duyetNghi.php">Duyệt nghỉ</a>
                        <?php
                    }
                    ?>
                    <a class="dropdown-item" href="api/chiTietNV.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="updatePassword.php">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="api/nghiphep.php">Xin nghỉ</a>
                    <a class="dropdown-item" href="updateImage.php">Đổi hình đại diện</a>
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>

    <?php 
        if(check_truong_phong($data['name'], $data['maPB']) == false){
            ?>
                <h3 style='color: red;'>Xin chào nhân viên <?=$data['name']?> quay trở lại</h3>
                <a href="api/taskNV.php">Task</a>
            <?php
        }else{
            ?>
                <h3 style='color: red;'>Xin chào trưởng phòng <?=$data['name']?> quay trở lại</h3>
                <a href="">Mấy cái đường link chức năng</a>
            <?php
        }
    ?>
    


    <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
        <?php
        if(!empty($error)){
            echo "<div class='alert alert-danger'>$error</div>";
        }else if(!empty($success)){
            echo "<div class='alert alert-success'>$success</div>";
        }
        ?>
    </p>

</body>
</html>