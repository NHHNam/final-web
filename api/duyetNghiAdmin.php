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
    <title>Duyệt đơn nghỉ phép</title>
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
            color: red;
        }
        .back{
            font-size: 30px;
            color: red;
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

        }
    ?>


<?php 
        if(isset($_POST['duyet'])){
            $nameNV = $_POST['nameNvToDuyet'];
            $status = "approved";
            $id = $_POST['id'];
            $resultDuyet = approve_xin_nghi_by_truong_phong($nameNV, $status, $id);
            if($resultDuyet['code'] == 0){
                $success = $resultDuyet['message'];
            }else{
                $error = $resultDuyet['message'];
            }
            // print_r($_POST);
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
    <div style="margin: 10px;">
        <a class="back" style="text-decoreation: none;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i> Quay lại</a>
    </div>
    <div class="container">  
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Nhân viên</th>
                    <th>Reason</th>
                    <th>Tình trạng</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_all_nghiphep_admin();
                    if($resultList['code'] == 0){
                        $data1 = $resultList['data'];
                        if(count($data1) > 0 && is_array($data1)){
                            
                            foreach ($data1 as $row1) {
                                if($row1['status'] == "waiting"){
                                    if(check_truong_phong($row1['name'], $row1['maPB']) == true){
                                        ?>
                                        <tr>
                                            <td><?=$stt?></td>
                                            <td><?=$row1['name']?></td>
                                            <td><?=$row1['reason']?></td>
                                            <td><?=$row1['status']?></td>
                                            <td>
                                                <button onclick="update_name_duyet_nghi('<?=$row1['name']?>', <?=$row1['id']?>)" class="btn btn-primary"data-toggle="modal" data-target="#confirm-duyet">approve</button>
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
                    
        
    

        <?php 
            
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
    

      <!-- confirm duyệt nghỉ phép -->
    <div class="modal fade" id="confirm-duyet">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post" enctype="multipart/form-data">
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
                     <button type="submit" name="duyet" class="btn btn-danger">Duyệt</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>

      <div class="modal fade" id="confirm-reject">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post" enctype="multipart/form-data">
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