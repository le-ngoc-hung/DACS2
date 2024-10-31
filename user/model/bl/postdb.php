<?php
class PostDatabase extends Database{
    function displayAll(){
        $sql = "SELECT * FROM bai_dang_ca_nhan";
        $Posts = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                $Posts[] = $Post;
            }
        } 
        else {
            return []; 
        }
        return $Posts;
    }

    function displayLimit($limit, $offset) {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan LIMIT $limit OFFSET $offset";
        $Posts = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                $Posts[] = $Post;
            }
        } else {
            return []; 
        }
        return $Posts;
    }
    
    function countRow(){
        $sql = "SELECT COUNT(*) as total FROM bai_dang_ca_nhan";
        $result = self::db_get_list($sql);
        if ($result){
            $total = $result[0]['total'];
        }
        return $total;
    }

    function getById($id){
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE ma_bai_dang = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                return $Post;
            }
        } 
        else {
            return []; 
        }
    }

    function getBuy($id){
        $sql = "SELECT COUNT(*) as total FROM nha_tuyen_dung_chon WHERE ma_bai_dang = :id";
        $params = [
            "id" =>(int)$id,
        ];
        $result = self::db_get_list_condition($sql,$params);
        if ($result){
            foreach ($result as $row){
                return $row['total'];
            }
        }
        else{
            return 0;
        }
    }

    function orderByLatest($limit,$offset){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan ORDER BY ngay_tao DESC LIMIT $limit OFFSET $offset";
        $Posts = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                $Posts[] = $Post;
            }
        } 
        else {
            return []; 
        }
        return $Posts;
    }

    function orderByPrice($limit,$offset){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan ORDER BY gia DESC LIMIT $limit OFFSET $offset";
        $Posts = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                $Posts[] = $Post;
            }
        } 
        else {
            return []; 
        }
        return $Posts;
    }

    function orderByPopular($limit,$offset){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT bd.*, COUNT(ntdc.ma_bai_dang) AS so_luong_chon
                FROM bai_dang_ca_nhan AS bd
                LEFT JOIN nha_tuyen_dung_chon AS ntdc ON bd.ma_bai_dang = ntdc.ma_bai_dang
                GROUP BY bd.ma_bai_dang
                ORDER BY so_luong_chon DESC
                LIMIT $limit OFFSET $offset";
        $Posts = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Post = new Post();
                $Post->setPostId($row['ma_bai_dang']);
                $Post->setFreeId($row['ma_nguoi_tim_viec']);
                $Post->setTitle($row['tieu_de']);
                $Post->setContent($row['noi_dung']);
                $Post->setCreateDate($row['ngay_tao']);
                $Post->setPrice($row['gia']);
                $Post->setImg($row['hinh_anh']);
                $Post->setSpeId($row['ma_chuyen_nganh']);
                $Posts[] = $Post;
            }
        } 
        else {
            return []; 
        }
        return $Posts;
    }
}
?>