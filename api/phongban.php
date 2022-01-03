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
    <title>Danh sách phòng ban</title>
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
        $success = "";
        $error = "";
        if(isset($_POST['editPB'])){
            $maPBEdit = $_POST['maPBToEdit'];
            $namePBEdit = $_POST['namePBEdit'];
            $descPB = $_POST['descPB'];

            $resultEdit = edit_phong_ban($namePBEdit, $descPB, $maPBEdit);
            if($resultEdit['code'] == 0){
                $success = $resultEdit['message'];
            }else{
                $error = $resultEdit['message'];
            }
        }
        
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
    <div>
        <div style="margin: 5px;">
            <a style="text-decoreation: none;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
        </div>
	<div class="container">
            <h2 style="color: #C71585; text-align: center;"> QUẢN LÝ PHÒNG BAN </h2>
            <div style="margin: 15px;">
      		<button class="btn btn-primary"><a style="text-decoration: none; color: #fff;" href="../addPB.php">Thêm phòng ban</a></button>
       	    </div>   
        <div class="table-responsive">
                <table border="1" class="table table-lg table-striped text-center">
                    <thead>
                        <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                            <th>STT</th>
                            <th>Tên phòng ban </th>
                            <th>Tên trưởng phòng</th>
                            <th colspan="3">Trạng thái</th>                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $stt = 1;
                            $resultList = get_info_phongban();
                            if ($resultList['data']->num_rows > 0) {
                                while($row1 = $resultList['data']->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><a style="text-decoration: none; color: black; font-weight: bold;" ><?=$row1["namePB"]?></a></td>
                            <td>
                                <?php 
                                    $resultGet = get_truong_phong($row1['maPB']);
                                    if($resultGet['code'] == 0){
                                        $dataPB = $resultGet['data'];
                                        echo "".$dataPB['name'];
                                    }else{
                                        echo "".$resultGet['message'];
                                    }
                                ?>
                            </td>
                            <td><a href="dsNVPB.php?maPB=<?=$row1['maPB']?>" style="color: black">View employee list</a></td>
                            <td>
                                <a href="chitietPB.php?maPB=<?=$row1['maPB']?>"><i class="fa fa-eye" style="color: black;"></i></a>
                            </td>
                            <td>
                                <i 
                                    class="fas fa-edit"
                                    style="cursor: pointer"
                                    onclick="update_field_edit_phongban('<?=$row1['namePB']?>', '<?=$row1['mota']?>', '<?=$row1['maPB']?>')"
                                    data-toggle="modal" data-target="#confirm-edit-PB"
                                >
                                </i>
                            </td>
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
       </div>
    </div>
    
    <div class="modal fade" id="confirm-edit-PB">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">CHỈNH SỬA THÔNG TIN PHÒNG BAN</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                        </div>
                        <input class="input-group-text" type="text" id="namePBEdit" name="namePBEdit" placeholder="Nhập tên phòng ban">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                        </div>
                        <input type="text" class="input-group-text" id="descPB" name="descPB" placeholder="Nhập chi tiết phòng ban">
                    </div>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="maPBToEdit" id="maPBToEdit">
                     <button type="submit" name="editPB" class="btn btn-danger">Sửa</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
    <script src="../js/script.js"></script>
</body>
</html>
