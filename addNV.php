<?php 
    session_start();
    require_once('db.php');
    if(!$_SESSION['username']){
        header("Location: login.php");
    }else if($_SESSION['username'] != "admin"){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giám đốc</title>
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
        a i{
            font-size: 30px;
        }
    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
        $result = get_info_admin($username);
        if($result['code'] == 0){
            $data = $result['data'];
        }
    ?>
    <nav class="navbar navbar-expand-sm bg-info justify-content-between">
        <div class="nav-item">
            <h1 class="nav-link">Trang giám đốc</h1>
        </div>
        <div class="nav-item">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?=$data['image'] ?>" alt="" style="max-width: 50px; max-height: 50px;">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <a style="text-decoreation: none;" href="api/dsAllNV.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php 
        $success = "";
        $error = "";
        if(isset($_POST['addUser'])){
            $nameNV = $_POST['nameNV'];
            $accountname = "nv".$_POST['accountname'];
            $pwd = "nv".$_POST['accountname'];
            $phongBan = $_POST['phongBan'];
            $imageNV = "images/".$_FILES['hinhDaiDien']['name'];
            $tongngaynghi = 0;
            $duocnghi = 12;
            $status = 0;
            $cmnd = $_POST['cmnd'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            if(move_uploaded_file($_FILES['hinhDaiDien']['tmp_name'], $imageNV)){
                $resultAdd = add_new_nhanvien($nameNV, $accountname, $pwd, $phongBan, $imageNV, $tongngaynghi, $duocnghi, $status, $cmnd, $email, $phone, $address);
                if($resultAdd['code'] == 0){
                    $success = $resultAdd['message'];
                }else{
                    $error = $resultAdd['message'];
                }
            }

        }
    ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form novalidate method="post" enctype="multipart/form-data">
                        <h3>Thêm nhân viên mới</h3>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="nameNV" placeholder="Nhập tên của nhân viên">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-secret"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="cmnd" placeholder="Nhập chứng minh nhân dân của nhân viên">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="email" placeholder="Nhập email của nhân viên">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="phone" placeholder="Nhập số điện thoại của nhân viên">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="address" placeholder="Nhập địa chỉ của nhân viên">
                        </div>
                        
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <input class="input-group-text" style="width: 85%" type="text" name="accountname" placeholder="Nhập tên tài khoản của nhân viên">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                            </div>
                            <select name="phongBan">
                                <?php 
                                    $data = get_info_phongban();
                                    if($data['data']->num_rows > 0){
                                        while($row3 = $data['data']->fetch_assoc()){
                                ?>
                                <option class="input-group-text" value="<?=$row3['maPB']?>"><?=$row3['namePB']?></option>
                                <?php 
                                        }
                                    }else{
                                        $error = "No found data of phongban";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                            </div>
                            <input class="input-group-text" type="file" name="hinhDaiDien">
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
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100" name="addUser" value="Thêm nhân viên">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>