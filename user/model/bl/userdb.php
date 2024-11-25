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

    function displayLimit($limit, $offset, $search = '') {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap LIKE :search and vai_tro <> :vai_tro LIMIT $limit OFFSET $offset";
        $params = [
            "search" => '%' . $search . '%',
            "vai_tro" => 'quan_ly',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Users = [];
        if ($result) {
            foreach ($result as $row) {
                $user = new User();
                $user->setUserId($row['ma_nguoi_dung']);
                $user->setUserName($row['ten_dang_nhap']);
                $user->setPass($row['mat_khau']);
                $user->setEmail($row['email']);
                $user->setRole($row['vai_tro']);
                $user->setCreateDate($row['ngay_tao']);
                $user->setUpdateDate($row['ngay_cap_nhat']);
                $Users[] = $user;
            }
        } else {
            return []; 
        }
        return $Users; 
    }

    function countRow($search=''){
        $sql = "SELECT COUNT(*) as total FROM nguoi_dung WHERE ten_dang_nhap LIKE :search and vai_tro <> :vai_tro";
        $params = [
            "search" => '%' . $search . '%',
            "vai_tro" => 'quan_ly',
        ];
        $result = self::db_get_row($sql, $params);
        $total = 0;
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }

    function countRowByRole($role, $search = '') {
        $sql = "SELECT COUNT(*) as total 
                FROM nguoi_dung 
                WHERE ten_dang_nhap LIKE :search 
                  AND vai_tro = :role";
        $params = [
            "search" => '%' . $search . '%',
            "role" => $role,
        ];
        $result = self::db_get_row($sql, $params);
        $total = 0;
        if ($result) {
            $total = $result['total'];
        }
        return $total;
    }
    

    function getUserListByRole($role, $search = '', $limit, $offset) {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * 
                FROM nguoi_dung 
                WHERE vai_tro = :role AND ten_dang_nhap LIKE :search LIMIT $limit OFFSET $offset";
        $params = [
            "role" => $role,
            "search" => '%' . $search . '%',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Users = [];
        if ($result) {
            foreach ($result as $row) {
                $user = new User();
                $user->setUserId($row['ma_nguoi_dung']);
                $user->setUserName($row['ten_dang_nhap']);
                $user->setPass($row['mat_khau']);
                $user->setEmail($row['email']);
                $user->setRole($row['vai_tro']);
                $user->setCreateDate($row['ngay_tao']);
                $user->setUpdateDate($row['ngay_cap_nhat']);
                $Users[] = $user;
            }
        } else {
            return []; 
        }
        return $Users; 
    }

    function login($username, $password) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :username";
        $params = [
            "username" => $username,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result) {
            // Kiểm tra mật khẩu
            if (password_verify($password, $result['mat_khau'])) {
                $user = new User();
                $user->setUserId($result['ma_nguoi_dung']);
                $user->setUserName($result['ten_dang_nhap']);
                $user->setPass($result['mat_khau']);
                $user->setEmail($result['email']);
                $user->setRole($result['vai_tro']);
                $user->setCreateDate($result['ngay_tao']);
                $user->setUpdateDate($result['ngay_cap_nhat']);
                return $user; // Đăng nhập thành công
            }
        }
        return null; // Đăng nhập thất bại
    }
    
    function deleteUserById($userId) {
        $userId = (int)$userId;
        
        $sql = "DELETE FROM nguoi_dung WHERE ma_nguoi_dung = :userId";
        
        $params = [
            "userId" => $userId
        ];

        $result = self::db_execute($sql, $params);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getByUsername($username) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :username";
        
        $params = ['username' => $username];
        
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
        return null; 
    }
    
}
?>