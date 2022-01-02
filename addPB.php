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
                <?= $data['name'] ?>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <a style="text-decoreation: none;" href="api/phongban.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php 
        $success = "";
        $error = "";
        if(isset($_POST['add'])){
            $maPB = $_POST['maPB'];
            $namePB = $_POST['namePB'];
            $moTa = $_POST['moTa'];
            $resultAddPB = add_new_phongban($maPB, $namePB, $moTa);
            if($resultAddPB['code'] == 0){
                $success = $resultAddPB['message'];
            }else{
                $error = $resultAddPB['message'];
            }
        }
    ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form novalidate method="post" enctype="multipart/form-data">
                        <h3>Thêm phòng ban mới</h3>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <input class="input-group-text" type="text" name="namePB" placeholder="Nhập tên phòng ban">
                        </div>
                        
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                            </div>
                            <input class="input-group-text" type="text" name="maPB" placeholder="Nhập số phòng PB">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <input class="input-group-text" type="text" name="moTa" placeholder="Nhập mô tả phòng ban">
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
                            <input type="submit" name="add" value="Thêm phòng ban">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>