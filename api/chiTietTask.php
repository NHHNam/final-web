<?php
session_start();
require_once('../db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết công việc</title>
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
        .nav-item .dropdown-toggle{
            max-width: 50px;
        }
        a i{
            font-size: 30px;
        }
        .tinhchinh{
            margin-top: 20px;
            text-align: center;
        }
        .tinhchinh .btn{
            width: 500px;
            padding: 10px;
        }
    </style>
</head>
<body>
<?php
$username = $_SESSION["username"];
$result = get_info_nhanvien($username);
if($result['code'] == 0){
    $data = $result['data'];
}
?>
<nav class="navbar navbar-expand-sm bg-info justify-content-between">
    <div class="nav-item">
        <a href="../index.php" style="text-decoration: none; color: black;"><h1 class="nav-link">Trang nhân viên</h1></a>
    </div>
    <div class="nav-item">
        <div class="dropdown">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <?= $data['name'] ?>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>
<?php
$error = "";
$tenTask = $_GET['tenTask'];
$result1 = get_task_by_name($tenTask);
if($result1['code'] == 0){
    $data1 = $result1['data'];
}else{
    $error = $result1['message'];
}
?>

<?php
if(check_truong_phong($data['name'], $data['maPB']) == true){
    ?>
        <a style="text-decoreation: none;" href="truongphong.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php
}else{
    ?>
        <a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php
}
?>

<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                    <h3>Thông tin task</h3>
                    <div class="form-group">
                        <label>Tên nhân viên:</label>
                        <div class="form-control"><?=$data1['nhanvien']?></div>
                    </div>

                    <div class="form-group">
                        <label>Tên task:</label>
                        <div class="form-control"><?=$data1['tenTask']?></div>
                    </div>

                    <div class="form-group">
                        <label>Chi tiết:</label>
                        <textarea class="form-control" rows="5" cols="100">
                            <?=$data1['descTask']?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>Hạn nộp:</label>
                        <div class="form-control"><?=$data1['deadline']?></div>
                    </div>

                    <div class="form-group">
                        <label>Tình trạng:</label>
                        <div class="form-control"><?=$data1['status']?></div>
                    </div>

                    <div class="form-group">
                        <label>Mã của phòng ban:</label>
                        <div class="form-control"><?=$data1['maPB']?></div>
                    </div>
                    <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                        <?php
                        if(!empty($error)){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>
                    </p>
            </div>
        </div>
    </div>
</div>
    <?php
        if(check_truong_phong($data['name'], $data['maPB']) == true){
            ?>
            <div class="tinhchinh">
                <button class="btn btn-success">Duyệt</button>
                <button class="btn btn-danger">Từ chối</button>
            </div>
            <?php
        }else{
            ?>
            <div class="tinhchinh">
                <button class="btn btn-success">Nộp</button>
            </div>
            <?php
        }
    ?>

</div>
</body>
</html>