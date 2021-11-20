<?php 
    session_start();
    require_once("../conn.php");
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
    <title>Trang Admin</title>

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
            <a class="navbar-brand" href="../admin.php">Trang Admin</a>
            <!-- Right -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5 align-items-center">
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
    </nav>
    <a href="../admin.php"><i class="fas fa-arrow-left ml-5 mt-5 p-1"></i></a>

    <div class="table-responsive">
            <table border="1" class="table table-lg table-striped text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ tên nhân viên: </th>
                        <th>Trạng thái</th>                    
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $stt = 1;
                        $sql1 = "SELECT * FROM nhanvien n, user u where n.username = u.username";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$stt?></td>
                        <td><?=$row1["name"]?></td>
                        <td>
                        <form method="post" action="deleteUser.php">
                            <input type="hidden" value="<?=$row1['id']?>" name="id_user">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                    </tr>

                    <?php 
                        $stt += 1;    
                        }
                        }else{
                            echo "No result found";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
    </div>
    <button class="btn btn-primary"><a style="color: white; text-decoration: none;" href="../addUserNV.php">Thêm nhân viên</a></button>

</body>
</html>