<?php

use function PHPSTORM_META\type;

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
        if(isset($_POST['startDo'])){
            $status = "In progress";
            $nameTask = $_POST['nameTask'];
            $resultStart = start_task($nameTask, $status);
            if($resultStart['code'] == 0){
                $success = $resultStart['message'];
            }else{
                $error = $resultStart['message'];
            }
        }    
    ?>

    <?php
    if(!check_truong_phong($data['name'], $data['maPB']) == true){
        $nameOfNv = $data['name'];
        $maPBOfNv = $data['maPB'];
        ?>
        <h3 style='color: red;'>Xin chào nhân viên <?=$nameOfNv?> quay trở lại</h3>
        <h2>Các Task hiện có: </h2>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên task </th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_task_by_nhan_vien($nameOfNv, $maPBOfNv);
                    if($resultList['code'] == 0){
                        $dataOfTask = $resultList['data'];
                        if(count($dataOfTask) > 0 && is_array($dataOfTask)){
                            foreach ($dataOfTask as $row1) {
                                ?>
                                <tr>
                                    <td><?=$stt?></td>
                                    <td><a style="text-decoration: none; color: black;" href="chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                                    <td><?=$row1['status']?></td>
                                    <td>
                                        <?php 
                                            if($row1['status'] == "New"){
                                                ?>
                                                    <form method="post">
                                                        <input type="hidden" name="nameTask" value="<?=$row1['tenTask']?>">
                                                        <input class="btn btn-primary" name="startDo" type="submit" value="Start">
                                                    </form>
                                                <?php
                                            }else{
                                                ?>
                                                    <p>No Thing To Do</p>
                                                <?php
                                            }
                                        ?>
                                        
                                    </td>
                                </tr>
                                <?php
                                $stt += 1;
                            }
                        }
                    }else{
                        ?>
                            <div class="alert alert-danger">Không có task được giao</div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <h2>Các Task đã hoàn thành: </h2>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên task </th>
                    <th>Tình trạng</th>
                    <th>Quality</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_task_completed_by_nhanvien($data['name'], $data['maPB']);
                    $dataOfTask = $resultList['data'];
                    if(sizeof($dataOfTask) > 0){
                        foreach ($dataOfTask as $row1) {
                            ?>
                            <tr>
                                <td><?=$stt?></td>
                                <td><a style="text-decoration: none; color: black;" href="chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                                <td><?=$row1['status']?></td>
                                <td><?=$row1['quality']?></td>
                                
                            </tr>
                            <?php
                            $stt += 1;
                        }
                    }else{
                        ?>
                            <div class="alert alert-danger">Không có task được giao</div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }else{
        ?>

            <?php
                $nameTP = $data['name'];
                echo "<h3 style='color: red;'>Xin chào trưởng phòng $nameTP quay trở lại</h3>";
            ?>
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