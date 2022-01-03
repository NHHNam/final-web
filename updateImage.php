<?php
    session_start();
    require_once("db.php");
    if(!$_SESSION["username"]){
        header("Location: login.php");
    }
    
    $error = "";
    $success = "";

    $username = $_SESSION["username"];
    $result = get_info_nhanvien($username);
    if($result['code'] == 0){
        $data = $result['data'];
    }else{
        $error = $result['message'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi ảnh đại diện</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        .nav-item .dropdown{
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle .dropdown-menu{
            max-width: 50px;
        }
        .back {
            font-size: 30px;
            color: red;
        }
        a i{
            font-size: 30px;
            color: red;
        }
	    .card{
            width: 50%;
            height: 100%;
            background:rgb(156,211,150);
            border-radius: 16px
        }
        h1{
            text-align: center;
        }
        .input-group{
            margin-top: 35px;
            display: flex;
            justify-content: center;
        }
        .button-submit{
            margin-top: 35px;
            display: flex;
            justify-content: center;
        }
        body{
            background: rgb(229,229,229);
        }
    </style>
</head>
<body>
    <?php 
        $resultNav = get_info_nhanvien($username);
        if($resultNav['code'] == 0){
            $data = $resultNav['data'];
        }
    ?>
    <nav class="navbar navbar-expand-sm bg-primary justify-content-between">
        <div class="nav-item">
            <h1 class="nav-link">Trang nhân viên</h1>
        </div>
        <div class="nav-item">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?=$data['image']?>" alt="Hinh dai dien" style="max-width: 40px;">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <a class="back" style="text-decoreation: none; margin: 10px;" href="index.php"><i class="fas fa-arrow-circle-left"></i> Quay lại</a>
    <?php 
        if(isset($_POST['updateImage'])){
            $image = "images/" . $_FILES['hinhDaiDien']['name'];
            if(move_uploaded_file($_FILES['hinhDaiDien']['tmp_name'], $image)){
                $resultChangeImage = change_image($image, $username);
                if($resultChangeImage['code'] == 0){
                    $success = $resultChangeImage['message'];
                }else{
                    $error = $resultChangeImage['message'];
                }
            }
        }
    ?>
    <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form novalidate method="post" enctype="multipart/form-data">
                            <h1>Sửa hình ảnh đại diện</h1>                         
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-image" style="font-size: 20px;"></i></span>
                                </div>
                                <input style="font-size: 20px;" type="file" name="hinhDaiDien">
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
                            <div class="form-group button-submit">
                                <input style="background: rgb(80,160,180);" type="submit" name="updateImage" value="Thay đổi ảnh">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>