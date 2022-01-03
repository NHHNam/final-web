<?php 
    session_start();
    require_once('../db.php');
    $error = "";
    $success = "";
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

    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
        if($username == "admin"){
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

    <?php 
        if(isset($_POST['duyet'])){
            $nameNV = $_POST['nameNvToDuyet'];
            $status = "approved";
            $id = $_POST['id'];
            $songay = $_POST['songay'];
            $resultDuyet = approve_xin_nghi_by_truong_phong($nameNV, $status, $id, $songay);
            if($resultDuyet['code'] == 0){
                $success = $resultDuyet['message'];
            }else{
                $error = $resultDuyet['message'];
            }
            
        }else if(isset($_POST['reject'])){
            $nameNV = $_POST['nameNvToReject'];
            $status = "rejected";
            $id = $_POST['idreject'];
            $resultRejected = reject_xin_nghi_by_truong_phong($nameNV, $status, $id);
            if($resultRejected['code'] == 0){
                $success = $resultRejected['message'];
            }else{
                $error = $resultRejected['message'];
            }
        }
    ?>
    <?php 
        if(check_truong_phong($data['name'], $data['maPB']) == true){
            ?>
                <p>Danh sách xin nghỉ của nhân viên trong phòng: </p>
                <div class="table-responsive">
                    <table class="table table-lg table-striped text-center">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Nhân viên</th>
                            <th>Reason</th>
                            <th>Số ngày</th>
                            <th>Tình trạng</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $stt = 1;
                            $resultList = get_don_nghiphep_truongphong($data['maPB']);
                            if($resultList['code'] == 0){
                                $data1 = $resultList['data'];
                                if(count($data1) > 0 && is_array($data1)){
                                    
                                    foreach ($data1 as $row1) {
                                        if($row1['status'] == "waiting"){
                                            if(check_truong_phong($row1['name'], $row1['maPB']) == false){
                                                ?>
                                                <tr>
                                                    <td><?=$stt?></td>
                                                    <td><?=$row1['name']?></td>
                                                    <td><?=$row1['reason']?></td>
                                                    <td><?=$row1['songay']?></td>
                                                    <td><?=$row1['status']?></td>
                                                    <td>
                                                        <button onclick="update_name_duyet_nghi('<?=$row1['name']?>', <?=$row1['id']?>, <?=$row1['songay']?>)" class="btn btn-primary"data-toggle="modal" data-target="#confirm-duyet">approve</button>
                                                        <button onclick="update_name_reject_nghi('<?=$row1['name']?>',<?=$row1['id']?>)" class="btn btn-primary" data-toggle="modal" data-target="#confirm-reject">reject</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $stt += 1;
                                            }
                                        }
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
                </br>
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

      <!-- confirm duyệt nghỉ phép -->
    <div class="modal fade" id="confirm-duyet">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Duyệt nghỉ phép</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div>
                        bạn có chắc muốn duyệt đơn xin nghỉ phép cho nhân viên <strong id="nhanVienCanDuyet">Hoài Nam</strong>
                    </div>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="nameNvToDuyet" id="nameNvToDuyet">
                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="songay" id="songay">
                     <button type="submit" name="duyet" class="btn btn-danger">Duyệt</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
        <!-- confirm từ chối nghỉ phép -->
      <div class="modal fade" id="confirm-reject">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Reject nghỉ phép</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div>
                        bạn có chắc muốn duyệt đơn xin nghỉ phép cho nhân viên <strong id="nhanVienCanReject">Hoài Nam</strong>
                    </div>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="nameNvToReject" id="nameNvToReject">
                      <input type="hidden" name="idreject" id="idreject">
                     <button type="submit" name="reject" class="btn btn-danger">reject</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
    <script src="../js/script.js"></script>
    
</body>
</html>