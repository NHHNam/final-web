<?php 
    session_start();
    require_once("conn.php");
    $error = "";

    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if((mysqli_num_rows($result)) > 0){

            $sql2 = "SELECT * FROM quanly WHERE username = '".$username."'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();

            $sql3 = "SELECT * FROM nhanvien WHERE username = '".$username."'";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();

            if(is_array($row2)){
                $_SESSION["username"] = $row2["username"];
                header("Location: quanly.php");
                exit();
            }else{
                $_SESSION["username"] = $row3["username"];
                header("Location: index.php");
                exit();
            }
        }else if($username == "admin"){
            $sql1 = "SELECT * FROM giamdoc WHERE username = '".$username."' && password = '".$password."'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            if($result1->num_rows > 0){
                $_SESSION['username'] = $row1['username'];
                header("Location: admin.php");
                exit();
            }
        }else{
            $error = "Invalid Username or Password!";
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-body">
                    <form novalidate method="post" action="#">
                        <header>Login Form</header>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="username" name="username" class="form-control" placeholder="username" required>
                            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                        </div>
                        <p style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                            <?php
                                if($error){
                                    echo $error;
                                } 
                            ?>
                        </p>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn login_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>