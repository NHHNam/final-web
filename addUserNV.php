<?php 
    session_start();
    require_once("conn.php");
    if(!$_SESSION["username"]){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Thêm nhân viên mới</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    

    <style>
        .nav-item a{
            text-decoration: none;
            color: white;
        }
        a{
            text-decoration: none;
        }
        a i{
            margin-bottom: 30px;
            font-size: 25px;
            color: #fff;
            background-color: red;
            padding: 10px;
            border: 1px solid black;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <?php
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM giamdoc WHERE username = '$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    ?>
    <nav class="navbar navbar-expand-sm navbar-dark  bg-dark p-3">
            <a class="navbar-brand" href="admin.php">Trang Admin</a>
            <!-- Right -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5 align-items-center">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
    </nav>
    

    <a href="api/dsNhanVien.php"><i class="fas fa-arrow-left ml-5 mt-5 p-1"></i></a>
    <?php 
        require_once("conn.php");
        mysqli_set_charset($conn,'UTF8');
        var_dump($_FILES);
        if(isset($_POST["addUser"])){
            $name = $_POST["name"];
            $ngaySinh = $_POST["dateBorn"];
            $noiSinh = $_POST["placeBorn"];
            $userName = $_POST["username"];
            $pwd = $_POST['pwd'];
            $sdt = $_POST['phoneNumber'];
            $hinhuser = 'images/'.$_FILES['hinhuser']['name'];
            move_uploaded_file($_FILES['hinhuser']['tmp_name'], $hinhuser);
            $sql1 = "INSERT INTO user(username,password,name,ngaysinh,noisinh,sdt,image) VALUES(?,?,?,?,?,?,?)";
            $sql2 = "INSERT INTO nhanvien(username) VALUES(?)";
            $stmt = $conn->prepare($sql1);
            $stmt1 = $conn->prepare($sql2);
            $stmt->bind_param("sssssis",$userName, $pwd, $name, $ngaySinh, $noiSinh, $sdt, $hinhuser);
            $stmt1->bind_param("s",$userName);
            $success = $stmt->execute(); 
            $success2 = $stmt1->execute();
            $stmt->close();
            $stmt1->close();
            $conn->close();
            if($success && $success2){
                header("Location: api/dsNhanVien.php");
            }
        }
    ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <header>Thêm nhân viên mới</header>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="dateBorn">Ngày sinh:</label>
                            <input type="date" class="form-control" id="dateBorn" name="dateBorn">
                        </div>
                        <div class="form-group">
                            <label for="name">Nơi sinh:</label>
                            <input type="text" class="form-control" id="placeBorn" name="placeBorn">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="pwd">
                        </div>
                        <div class="form-group">
                            <label for="hinhuser">Hình nhân viên:</label>
                            <input type="file" class="form-control" id="hinhuser" name="hinhuser" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Số điện thoại:</label>
                            <input type="number" class="form-control" id="phoneNumber" name="phoneNumber">
                        </div>
                        <input type="submit" class="form-control" name="addUser">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>