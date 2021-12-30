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
        .content{
            display: flex;
            justify-content: center
        }
        .functional-area{
            margin: 20px;
            width: 230px;
            height: 345px;
            float: left;
            box-shadow: 4px 4px 10px 2px rgba(0, 0, 0, 0.2); 
        }
        .functional-area:hover {
            box-shadow: 4px 4px 10px 2px rgba(0, 0, 0, 0.5);   
            transition: 0.2s;  
        }
        .functional-area .name{
            margin-bottom: 8px;
            padding-left: 20px;
            font-weight: bold;
            font-size: 16px;
            display: block;
            text-align: center;
        }
        .functional-area img{
            width: 100%;
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
    <nav class="navbar navbar-expand-sm bg-primary justify-content-between">
        <div class="nav-item">
            <h1 class="nav-link">Trang giám đốc</h1>
        </div>
        <div class="nav-item">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?= $data['image'] ?>" alt="Hinh dai dien" style="max-width: 40px;">
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="content">
        
        <div class="functional-area" onclick="location.href='api/phongban.php'">
            <img src="./images/dsphongban.jpg">
            <div class="name">Danh sách phòng ban</div>
        </div>
        <div class="functional-area" onclick="location.href='api/dsAllNV.php'">
            <img src="./images/dsnhanvien.jpg">
            <div class="name">Danh sách nhân viên</div>
        </div>
        <div class="functional-area" onclick="location.href='api/duyetNghiAdmin.php'">
            <img src="./images/dsdonnghiphep.jpg">
            <div class="name">Danh sách đơn nghỉ phép</div>
        </div>
    </div>
        
</body>
</html>
