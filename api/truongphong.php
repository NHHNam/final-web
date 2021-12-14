<?php
session_start();
require_once('../db.php');
if(!$_SESSION['username']){
    header("Location: ../login.php");
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
        <a href="../index.php" style="text-decoration: none; color: black;"><h1 class="nav-link">Trang nhân viên</h1></a>
    </div>

    <div class="nav-item">
        <div class="dropdown">
            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?= "../".$data['image'] ?>" alt="Hinh dai dien" style="max-width: 40px;">
            </button>
            <div class="dropdown-menu">
                <?php
                if(check_truong_phong($data['name'], $data['maPB']) == true){
                    ?>
                    <a class="dropdown-item" href="">Trưởng phòng</a>
                    <?php
                }
                ?>
                <a class="dropdown-item" href="../updatePassword.php">Đổi mật khẩu</a>
                <a class="dropdown-item" href="../updateImage.php">Đổi hình đại diện</a>
                <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
            </div>
        </div>
    </div>
</nav>

<div class="table-responsive">
    <h2>Các Task hiện có: </h2>
    <br>
    <table class="table table-lg table-striped text-center">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên task </th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stt = 1;
        $resultList = get_all_task_by_phong_ban($data['maPB']);
        if($resultList['code'] == 0){
            foreach ($resultList['data'] as $row1) {
            ?>
            <tr>
                <td><?=$stt?></td>
                <td><a style="text-decoration: none; color: black;" href="chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                <td><?=$row1['status']?></td>
                <td>
                    <button type="submit" class="btn btn-success">Edit</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </td>
            </tr>

            <?php
                $stt += 1;
            }
        }else{
            ?>
                <h4>Không có dữ liệu nào hết</h4>
            <?php
        }
        ?>
        </tbody>
    </table>
    <br>
    <h2>Các Task đã hoàn thành: </h2>
    <br>
    <table class="table table-lg table-striped text-center">
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên task </th>
            <th>Trạng thái</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $st = 1;
        $resultList1 = get_task_success($data['maPB']);
        if($resultList1['code'] == 0){
            foreach ($resultList1['data'] as $row) {
                ?>
                <tr>
                    <td><?=$st?></td>
                    <td><a style="text-decoration: none; color: black;" href="chiTietTask.php?tenTask=<?=$row['tenTask']?>"><?=$row['tenTask']?></a></td>
                    <td><?=$row['status']?></td>
                    <td>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </td>
                </tr>

                <?php
                $stt += 1;
            }
        }else{
            ?>
            <h4>Không có dữ liệu nào hết</h4>
            <?php
        }
        ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary"><a href="../addTask.php" style="text-decoration: none; color: white;">Giao task mới</a></button>
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
