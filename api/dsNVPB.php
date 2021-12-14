<?php 
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }else if($_SESSION['username'] != "admin"){
        header("Location: ../index.php");
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
                    <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <a style="text-decoreation: none;" href="phongban.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php 
        $success = "";
        $error = "";
        $maPB = $_GET['maPB'];

        if(isset($_POST['boNhiem'])){
            $nameBoNhiem = $_POST['nameNVToBoNhiem'];
            $maPBBoNhiem = $_POST['phongBanBoNhiem'];

            $resultBoNhiem = choose_truong_phong($nameBoNhiem, $maPBBoNhiem);

            if($resultBoNhiem['code'] == 0){
                $success = $resultBoNhiem['message'];
            }else{
                $error = $resultBoNhiem['message'];
            }
        }else if(isset($_POST['huyBoNhiem'])){
            $nameBoNhiem = "";
            $maPBBoNhiem = $_POST['phongBanBoNhiem'];
            $resultHuyBoNhiem = reject_truong_phong($nameBoNhiem, $maPBBoNhiem);

            if($resultHuyBoNhiem['code'] == 0){
                $success = $resultHuyBoNhiem['message'];
            }else{
                $error = $resultHuyBoNhiem['message'];
            }
        }else if(isset($_POST['del'])){
            $id = $_POST['idToDel'];
            $result4 = delete_nhan_vien($id);

            if($result4['code'] == 0){
                $success = $result4['message'];
            }else{
                $error = $result4['message'];
            }
        }

        $result3 = get_button_truongphong($maPB);
        if($result3['code'] == 0){
            $data3 = $result3['data'];
        }else{
            $error = $result3['message'];
        }
    ?>
    <div class="table-responsive">
            <table border="1" class="table table-lg table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nhân viên</th>
                        <th>Trạng thái</th>
                        <th>Bổ nhiệm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $stt = 1;
                        $resultList = get_nhanvien_pb($maPB);
                        if ($resultList['data']->num_rows > 0) {
                            while($row1 = $resultList['data']->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$stt?></td>
                        <td><a style="text-decoration: none; color: black; font-weight: bold;" href="chiTietNV.php?name=<?=$row1['name']?>"><?=$row1["name"]?></a></td>
                        <form method="post">
                            <input type="hidden" name="idToDel" value="<?=$row1['id']?>">
                            <td><button type="submit" name="del" class="btn btn-danger">DELETE</button></td>
                        </form>
                        <?php
                            if($data3['truongphong'] == $row1['name']){
                                ?>
                                <form method="post">
                                    <input type="hidden" name="phongBanBoNhiem" value="<?=$maPB?>">
                                    <td><button type="submit" name="huyBoNhiem" class="btn btn-danger">Bỏ Chọn</button></td>
                                </form>
                                <?php
                            }else{
                                ?>
                                <form method="post">
                                    <input type="hidden" name="nameNVToBoNhiem" value="<?=$row1['name']?>">
                                    <input type="hidden" name="phongBanBoNhiem" value="<?=$maPB?>">
                                    <td><button type="submit" name="boNhiem" class="btn btn-success">Chọn</button></td>
                                </form>
                                <?php
                            }
                        ?>


                    </tr>

                    <?php 
                        $stt += 1;    
                        }
                        }else{
                            echo "No result found";
                        }
                    ?>
                </tbody>
            </table>
            <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                <?php
                    if(!empty($error)){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }else if(!empty($success)){
                        echo "<div class='alert alert-success'>$success</div>";
                    }
                ?>
            </p>
    </div>
</body>
</html>