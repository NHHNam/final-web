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
        * {
            box-sizing: border-box;
        }
        body {font-family: "Lato", sans-serif;}
        .nav-item .dropdown{
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle .dropdown-menu{
            max-width: 50px;
        }
        .flex-direction{
            display: flex;
            justify-content: center;
        }

        .flex-direction > div {
            background-color: #f1f1f1;
            margin: 50px;
            padding: 50px;
            font-size: 30px;
        }
        .card{
            text-align: center;
            margin-top: 10px;
            padding-bottom: auto;
            border-radius: 10px;
            box-shadow:4px 4px 10px 2px rgba(0,0,0,0.2) ;
        }
        .card img{
            width : 60%;
            height: 50%;
        }
       
        .card:hover{
            box-shadow: 4px 12px 14px 4px rgba(0,0,0,0.3);
        }
        h5{
            color: black;
            font-weight: bold;
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
                <a style="color: white;  text-transform:uppercase"> <?= $data['name'] ?></a>
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $data['image'] ?>" alt="Hinh dai dien" style="max-width: 40px;">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="api/chiTietNV.php">Thông tin cá nhân</a>
                    <a class="dropdown-item" href="updatePassword.php">Đổi mật khẩu</a>
                    <a class="dropdown-item" href="updateImage.php">Đổi hình đại diện</a>
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="flex-direction">
        <div class ="row">
            <?php 
                if(check_truong_phong($data['name'], $data['maPB']) == false){
            ?>
                <div class="col-12 col-sm-6">
                    <div class="card" style=" background: white ">
                        <div class="card-body text-center">
                            <img src="images/anh4.jpg" >
                                <a href="api/taskNV.php"><p></p><h5>NHIỆM VỤ</h5></a>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="card" style=" background: white">
                        <div class="card-body text-center">
                            <img src="images/anh3.jpg" >
                            <p> </p>
                            <a href="api/nghiphep.php"><h5>ĐƠN XIN NGHĨ PHÉP</h5></a>
                        </div>
                    </div>     
                </div>
            <?php
                }else{
            ?>
               
                <?php
                    if(check_truong_phong($data['name'], $data['maPB']) == true){
                ?>
                    <div class="col-12 col-sm-4 p-2">
                        <div class="card" style="background: white ;">
                            <div class="card-body text-center">
                                <img src="images/anh1.jpg" >  
                                    <a href="api/truongphong.php"><p></p><h5>QUẢN LÝ NHIỆM VỤ</h5></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 p-2">
                        <div class="card" style="background: white ; ">
                            <div class="card-body text-center">
                                <img src="images/anh3.jpg" >
                                <p> </p>
                                <a href="api/nghiphep.php"><h5>ĐƠN XIN NGHĨ PHÉP</h5></a>
                            </div>
                        </div>     
                    </div>

                    <div class="col-12 col-sm-4 p-2">
                        <div class="card" style="background: white ; ">
                            <div class="card-body text-center">
                                <img src="images/anh2.jpg" >
                                        <a href="api/duyetNghi.php"><p></p><h5>DUYỆT ĐƠN XIN NGHỈ PHÉP</h5></a>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            <?php
                }
            ?>
        </div>
    </div>
    
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
