<?php
session_start();
require_once('db.php');
if(!$_SESSION['username']){
    header("Location: login.php");
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
$result = get_info_nhanvien($username);
if($result['code'] == 0){
    $data = $result['data'];
}
?>
<nav class="navbar navbar-expand-sm bg-info justify-content-between">
    <div class="nav-item">
        <h1 class="nav-link">Trang nhân viên</h1>
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
<a style="text-decoreation: none;" href="api/quanlyTask.php"><i class="fas fa-arrow-circle-left"></i></a>
<?php
$success = "";
$error = "";
if(isset($_POST['add'])){
    $tenTask = $_POST['nameTask'];
    $descTask = $_POST['cTTask'];
    $PB = $_POST['maPB'];
    $nhanvien = $_POST['nhanvien'];
    $dead = $_POST['deadTask'];
    $status = "New";
    $fileNop = "";
    $quality = "";
    $resultAddTask = add_new_task($tenTask, $descTask, $nhanvien, $PB, $dead, $fileNop,$status, $quality);
    if($resultAddTask['code'] == 0){
        $success = $resultAddTask['message'];
    }else{
        $error = $resultAddTask['message'];
    }
}

?>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form novalidate method="post" enctype="multipart/form-data">
                    <h3>Giao task mới</h3>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                        </div>
                        <input class="input-group-text" type="text" name="nameTask" placeholder="Nhập tên task">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                        </div>
                        <textarea rows="5" cols="19" class="input-group-text" name="cTTask" placeholder="Nhập chi tiết task"></textarea>

                    </div>

                    <div class="input-group form-group">
                        <input class="input-group-text" type="hidden" name="maPB" value="<?=$data['maPB']?>">
                    </div>

                    <div class="input-group form-group">
                        <select name="nhanvien">
                            <?php
                                $result3 = get_nhanvien_pb($data['maPB']);
                            if ($result3['data']->num_rows > 0) {
                                while($a = $result3['data']->fetch_assoc()) {
                                    if(check_truong_phong( $a['name'],$data['maPB']) == false){
                            ?>
                            <option value="<?=$a['name']?>"><?=$a['name']?></option>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                        </div>
                        <input class="input-group-text" type="date" name="deadTask">

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
                        <input type="submit" name="add" value="Giao task">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>