<?php 
    define('host', 'localhost');
    define('username', 'root');
    define('password', '');
    define('db','quanlynhanvien');

    function open_database(){
        $conn = mysqli_connect(host, username, password, db);
        if($conn->connect_error){
            die("Error connecting to database");
        }
        return $conn;
    }

    function login($username, $password){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'User are not exist');
        }
        return array('code' => 0, 'message'=>'','data' => $data);
    }
    
    function login_admin($username, $password){
        $conn = open_database();
        $sql = "SELECT * FROM giamdoc WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'User are not exist');
        }
        return array('code' => 0, 'message'=>'','data' => $data);
    }

    function get_info_nhanvien($username){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'No information nhanvien');
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function get_info_admin($username){
        $conn = open_database();
        $sql = "SELECT * FROM giamdoc WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' =>'No information giamdoc');
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }

    function change_password($newpwd, $cpwd ,$username){
        if($newpwd != $cpwd){
            return array('code' => 3, 'message' =>'Mật khẩu mới và mật khẩu nhập lại không trùng khớp với nhau');
        }else if($newpwd == "" || $cpwd == ""){
            return array('code' => 3, 'message' =>'Mật khẩu không được để trống');
        }

        $conn = open_database();
        $sql = "UPDATE nhanvien SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$newpwd, $username);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Thay mật khẩu không thành công');
        }

        return array('code' => 0, 'message' =>'Thay mật khẩu thành công');
    }

    function change_image($image, $username){
        $conn = open_database();
        $sql = "UPDATE nhanvien SET image = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$image, $username);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }

        return array('code' => 0, 'message' =>'Thay hình đại diện thành công');
    }

    function add_new_nhanvien($name, $username, $pwd, $maPB, $image){
        $conn = open_database();
        $sql = "INSERT INTO nhanvien (name, username, password,maPB,image) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss",$name, $username, $pwd, $maPB, $image);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $stmt->close();
        return array('code' => 0, 'message' =>'Thêm nhân viên mới thành công');
    }

    function get_info_phongban(){
        $conn = open_database();
        $sql = "SELECT * FROM phongban";
        $stmt = $conn->query($sql);
        return array('code' => 0, 'message' =>'', 'data' => $stmt);
    }

    function delete_phongban($maPB){
        $conn = open_database();
        $sql = "DELETE FROM phongban WHERE maPB = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$maPB);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $stmt->close();
        return array('code' => 0, 'message' =>'Xoá phòng ban thành công');
    }

    function add_new_phongban($maPB, $namePB){
        $conn = open_database();
        $sql = "INSERT INTO phongban (maPB, namePB) VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$maPB, $namePB);
        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $stmt->close();
        return array('code' => 0, 'message' =>'Thêm phòng ban mới thành công');
    }

    function get_nhanvien_pb($maPB){
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE maPB = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$maPB);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $result = $stmt->get_result();
        return array('code' => 0, 'message' =>'', 'data' => $result);
    }

    function get_all_info_nhanvien($name)
    {
        $conn = open_database();
        $sql = "SELECT * FROM nhanvien WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$name);

        if(!$stmt->execute()){
            return array('code' => 1, 'message' =>'Cannot execute query');
        }
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($result->num_rows == 0){
            return array('code' => 2, 'message' => 'Tìm không thấy thông tin nhân viên');
        }
        return array('code' => 0, 'message' =>'', 'data' => $data);
    }
?>