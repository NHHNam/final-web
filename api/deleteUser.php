<?php
    session_start();
    require_once("../conn.php");
    $id = $_POST['id_user'];
    $sql2 = "SELECT * FROM user where id = '".$id."'";
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_assoc();
    $username = $row['username'];
    $count = substr_count($username, 'nv');
    if($count > 0){
        echo $username;
        $sql2 = "DELETE FROM nhanvien WHERE username = '$username'";
        $sql3 = "DELETE FROM user WHERE username = '$username'";
        $resul2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
    
        if($result2 && $result3){
            header("Location: dsNhanVien.php");
            exit();
        }else{
            echo "Delete Fail";
        }
    }else{
        $sql = "DELETE FROM user WHERE username = '$username'";
        $sql1 = "DELETE FROM quanly WHERE username = '$username'";
        $result = $conn->query($sql);
        $result1 = $conn->query($sql1);
        
        if($result && $result1){
            header("Location: dsQuanLy.php");
            exit();
        }else{
            echo "Delete Fail";
        }
    }
    
?>