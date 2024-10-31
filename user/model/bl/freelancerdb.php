<?php
class FreelancerDatabase extends Database{
    function displayAll(){
        $sql = "SELECT * FROM nguoi_tim_viec";
        $FreeLancers = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $freelancer = new Freelancer();
                $freelancer->setFreeId($row['ma_nguoi_tim_viec']);
                $freelancer->setUserId($row['ma_nguoi_dung']);
                $freelancer->setName($row['ho_ten']);
                $freelancer->setBack($row['ly_lich']);
                $freelancer->setSkill($row['ky_nang']);
                $freelancer->setExp($row['kinh_nghiem']);
                $freelancer->setImg($row['anh']);
                $FreeLancers[] = $freelancer;
            }
        } 
        else {
            return []; 
        }
        return $FreeLancers;
    }

    function display($lim) {
        $sql = "SELECT * FROM nguoi_tim_viec LIMIT " . intval($lim);
        $params = [];
        $FreeLancers = [];
        $result = self::db_get_list_condition($sql, $params);
        if ($result) { 
            foreach ($result as $row) {
                $freelancer = new Freelancer();
                $freelancer->setFreeId($row['ma_nguoi_tim_viec']);
                $freelancer->setUserId($row['ma_nguoi_dung']);
                $freelancer->setName($row['ho_ten']);
                $freelancer->setBack($row['ly_lich']);
                $freelancer->setSkill($row['ky_nang']);
                $freelancer->setExp($row['kinh_nghiem']);
                $freelancer->setImg($row['anh']);
                $FreeLancers[] = $freelancer;
            }
        } else {
            return [];
        }
        return $FreeLancers;
    }
    
    function getById($id){
        $sql = "SELECT * FROM nguoi_tim_viec WHERE ma_nguoi_tim_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        if ($result) { 
            foreach ($result as $row) {
                $freelancer = new Freelancer();
                $freelancer->setFreeId($row['ma_nguoi_tim_viec']);
                $freelancer->setUserId($row['ma_nguoi_dung']);
                $freelancer->setName($row['ho_ten']);
                $freelancer->setBack($row['ly_lich']);
                $freelancer->setSkill($row['ky_nang']);
                $freelancer->setExp($row['kinh_nghiem']);
                $freelancer->setImg($row['anh']);
                return $freelancer;
            }
        }
        else {
            return [];
        }
    }
}
?>