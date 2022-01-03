<?php 
    session_start();
    require_once('../db.php');
    if(!$_SESSION["username"]){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết nhân viên</title>
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
	    th{
            background-image: linear-gradient(#F4A460,#FFFFCC);
        }
        .table{
            border: 1px solid black;
        }

    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
        if($username == "admin"){
            $nameNV = $_GET['name'];
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
            <?php

        }else{
            $result = get_info_nhanvien($username);
            if($result['code'] == 0){
                $data = $result['data'];
            }
            ?>
                <nav class="navbar navbar-expand-sm bg-info justify-content-between">
                    <div class="nav-item">
                        <h1 class="nav-link"><a href="../index.php" style="text-decoration: none; color: black;">Trang nhân viên</a></h1>
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
        }
    ?>
    <a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="container mt-2">
        <h2 style="color: #C71585; text-align: center;">QUẢN LÝ NGÀY NGHỈ </h2>
        <div class="row mb-5">
            <span  style="background:#CCFFFF; padding: 10px; border-radius: 5px;">Số lượt đã xin nghỉ trong tổng số lượt đã nghỉ <?=$data['tongngaynghi']?> / <?=$data['duocnghi']?></span>
        </div>
	<div class="row mb-5">
            <span style="background: #FF7F50; padding: 10px; border-radius:20px"><i class="fas fa-plus" data-toggle="modal" data-target="#confirm-xin-nghi"></i> Xin nghỉ</span>
        </div>
        <div class="row">
            </br>
            <?php 
                if(check_truong_phong($data['name'], $data['maPB']) == false){
                    ?>
                        <div class="table-responsive">
			<h3>Danh sách lịch sử các yêu cầu nghỉ phép:</h3>
                        <br>
                            <table class="table table-lg table-striped text-center">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Reason</th>
                                    <th>Tình trạng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $stt = 1;
                                    $resultList = get_don_nghiphep($data['name']);
                                    if($resultList['code'] == 0){
                                        $data1 = $resultList['data'];
                                        if(count($data1) > 0 && is_array($data1)){
                                            foreach ($data1 as $row1) {
                                                ?>
                                                <tr>
                                                    <td><?=$stt?></td>
                                                    <td><?=$row1['reason']?></td>
                                                    <td><?=$row1['status']?></td>
                                                </tr>
                                                <?php
                                                $stt += 1;
                                            }
                                        }
                                    }else{
                                        ?>
                                            <div class="alert alert-danger">Không có đơn xin nghỉ phép</div>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                }else if(check_truong_phong($data['name'], $data['maPB']) == true){
                    ?>
                        <div class="table-responsive">
			    <h3>Danh sách lịch sử các yêu cầu nghỉ phép:</h3>
                            <br>
                            <table class="table table-lg table-striped text-center">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Reason</th>
                                    <th>Tình trạng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $stt = 1;
                                    $resultList = get_don_nghiphep($data['name']);
                                    if($resultList['code'] == 0){
                                        $data1 = $resultList['data'];
                                        if(count($data1) > 0 && is_array($data1)){
                                            foreach ($data1 as $row1) {
                                                ?>
                                                <tr>
                                                    <td><?=$stt?></td>
                                                    <td><?=$row1['name']?></td>
                                                    <td><?=$row1['reason']?></td>
                                                    <td><?=$row1['status']?></td>
                                                </tr>
                                                <?php
                                                $stt += 1;
                                            }
                                        }
                                    }else{
                                        ?>
                                            <div class="alert alert-danger">Không có đơn xin nghỉ phép</div>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php 
                }
            ?>
            
            
            <?php 
                $error = "";
                $success = "";
                if(isset($_POST['nopNghiPhep'])){
                    $nameNV = $_POST['nameNV'];
                    $reason = $_POST['reason'];
                    $maPB = $_POST['maPB'];
                    $status = "waiting";
            
                    $resultXinNghi = xin_nghi($nameNV, $reason, $maPB, $status);
                    if($resultXinNghi['code'] == 0){
                        $success = $resultXinNghi['message'];
                    }else{
                        $error = $resultXinNghi['message'];
                    }
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
    </div>
    
    
    <!-- confirm nghỉ phép -->
    <div class="modal fade" id="confirm-xin-nghi">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post" enctype="multipart/form-data">
                  <div class="modal-header">
                     <h4 class="modal-title">Xin nghỉ phép</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div>
                        <span><i class="fa fa-user"></i></span>
                        <span><label>Tên nhân viên: </label></span>
                        <input style="width: 100%" type="text" name="nameNV" value="<?=$data['name']?>">
                    </div>

                    <div>
                        <span><i class="fa fa-book"></i></span>
                        <span><label>Lý do xin nghỉ: </label></span>
                        <textarea name="reason" style="width: 100%"></textarea>
                    </div>
			  
		     <div>
                        <span><i class="fa fa-book"></i></span>
                        <span><label>Số ngày muốn nghỉ: </label></span>
                        <input type="number" name="day" min="1" max="15" style="width: 100%">
                    </div>

                    <div>
                        <span><i class="fa fa-users"></i></span>
                        <span><label>Phòng ban: </label></span>
                        <input style="width: 100%" type="text" name="maPB" value="<?=$data['maPB']?>">
                    </div>
                  </div>
            
                  <div class="modal-footer">
                     <button type="submit" name="nopNghiPhep" class="btn btn-danger">Nộp</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
    <script src="../js/script.js"></script>
    
</body>
</html>
