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
    <title>Danh sách nhân viên</title>
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
            color: red;
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
        <div class="nav-item" onclick="location.href='../admin.php'">
            <h1 class="nav-link" >Trang giám đốc</h1>
        </div>
        <div class="nav-item">
            <div class="dropdown">
                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                <img src="<?= "../". $data['image'] ?>" alt="" style="max-width: 50px; max-height: 50px;">
                </button>
                
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div style="margin: 10px;">
            <a style="text-decoreation: none; " href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
        </div>
        
        <?php 
            $success = "";
            $error = "";
        ?>
        <div style="margin: 10px;">
            <button class="btn btn-primary"><a style="text-decoration: none; color: #fff;" href="../addNV.php">Thêm nhân viên</a></button>
        </div> 
        <div class="table-responsive" >
            <table border="1" class="table table-lg table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên nhân viên</th>
                        <th>Phòng ban</th>
                        <th>Chức vụ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $stt = 1;
                        $resultList = get_all_staff();
                        if($resultList['code'] == 0){
                            $dataNv = $resultList['data'];
                            foreach($dataNv as $a){
                                ?>
                                    <tr>
                                        <td><?=$stt?></td>
                                        <td><?=$a['name']?></td>            
                                        <td><?=$a['maPB']?></td>
                                        <?php
                                            if(check_truong_phong($a['name'], $a['maPB']) == true){
                                                $chucvu = 'Trưởng phòng';
                                            }
                                            else{
                                                $chucvu = 'Nhân viên';
                                            }
                                        ?>
                                        <td><?=$chucvu?></td>
                                        <td>
                                            <a href="chiTietNV.php?name=<?=$a['name']?>">View information</a>
                                        </td>                        
                                <?php
                                $stt+=1;
                            }
                        }else{
                            $error = $resultList['error'];
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
    </div>
    
    <div class="modal fade" id="confirm-delete">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Xóa nhân viên</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                  Bạn có chắc rằng muốn xóa nhân viên <strong id="file-to-delete">image.jpg</strong>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="idToDel" id="idNV">
                     <button type="submit" name="del" class="btn btn-danger">Xóa</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
      <script src="../js/script.js"></script>
</body>
</html>