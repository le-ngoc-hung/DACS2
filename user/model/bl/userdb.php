<?php
class UserDatabase extends Database{

    function getById($id){
        $sql = "SELECT * FROM nguoi_dung WHERE ma_nguoi_dung = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result) { 
            $user = new User();
            $user->setUserId($result['ma_nguoi_dung']);
            $user->setUserName($result['ten_dang_nhap']);
            $user->setPass($result['mat_khau']);
            $user->setEmail($result['email']);
            $user->setRole($result['vai_tro']);
            $user->setCreateDate($result['ngay_tao']);
            $user->setUpdateDate($result['ngay_cap_nhat']);
            return $user;
        }
        else {
            return null;
        }
    }

    function addUser($user){
        $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, email, vai_tro)
                VALUES (:userName, :pass, :email, :role) ";
        $hashed_password = password_hash($user->getPass(), PASSWORD_DEFAULT);
        $params = [
            "userName" => $user->getUserName(),
            "pass" => $hashed_password,
            "email" => $user->getEmail(),
            "role" => $user->getRole(),
        ];
        if (self::db_execute($sql, $params)){
            return true;
        }
        else{
            return false;
        }
    }

    function getLatestUser(){
        $sql = "SELECT * FROM nguoi_dung ORDER BY ngay_tao DESC LIMIT 1";
        $result = self::db_get_row($sql);
        if ($result) { 
            $user = new User();
            $user->setUserId($result['ma_nguoi_dung']);
            $user->setUserName($result['ten_dang_nhap']);
            $user->setPass($result['mat_khau']);
            $user->setEmail($result['email']);
            $user->setRole($result['vai_tro']);
            $user->setCreateDate($result['ngay_tao']);
            $user->setUpdateDate($result['ngay_cap_nhat']);
            return $user;
        }
        else {
            return null;
        }
    }

    function countByUserName($userName){
        $sql = "SELECT COUNT(*) as total FROM nguoi_dung WHERE ten_dang_nhap = :username";
        $params = [
            "username" => $userName,
        ];
        $total = 0;
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }
}
?>