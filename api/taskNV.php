<?php

    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
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
      
        .table{
            border: 1px solid black;
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
    if(check_truong_phong($data['name'], $data['maPB']) == false){
        $nameOfNv = $data['name'];
        $maPBOfNv = $data['maPB'];
        ?>
        <a style="text-decoreation: none;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="container">
            <br>
        <h2 style="color: #C71585; text-align: center;"> TASK </h2>
        <h3>Các Task hiện có: </h3>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
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
                                    <td><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
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
                            <div class="alert alert-primary"><?php echo $resultList['message']?></div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <h3>Các Task đã hoàn thành: </h3>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                    <th>STT</th>
                    <th>Tên task </th>
                    <th>Tình trạng</th>
                    <th>Quality</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_task_completed_by_nhanvien($data['name'], $data['maPB'], "Completed");
                    if($resultList['code'] == 0){
                        $dataOfTask = $resultList['data'];
                        foreach ($dataOfTask as $row1) {
                            ?>
                            <tr>
                                <td><?=$stt?></td>
                                <td><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                                <td><?=$row1['status']?></td>
                                <td><?=$row1['quality']?></td>
                                
                            </tr>
                            <?php
                            $stt += 1;
                        }
                    }else{
                        ?>
                            <div class="alert alert-primary"><?php echo $resultList['message']?></div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
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
    </div>
</body>
</html>