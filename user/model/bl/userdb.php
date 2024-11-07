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
}
?>