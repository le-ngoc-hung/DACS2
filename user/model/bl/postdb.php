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

    function displayLimit($limit, $offset, $search = '') {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE tieu_de LIKE :search LIMIT $limit OFFSET $offset";
        $params = [
            "search" => '%' . $search . '%',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Posts = [];
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
    
    function countRow($search){
        $sql = "SELECT COUNT(*) as total FROM bai_dang_ca_nhan WHERE tieu_de LIKE :search";
        $params = [
            "search" => '%' . $search . '%',
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }

    function countRowById($id){
        $id = (int)$id;
        $sql = "SELECT COUNT(*) as total FROM bai_dang_ca_nhan WHERE ma_nguoi_tim_viec = $id";
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

    function orderByLatest($limit, $offset, $search = '') {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE tieu_de LIKE :search ORDER BY ngay_tao LIMIT $limit OFFSET $offset";
        $params = [
            "search" => '%' . $search . '%',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Posts = [];
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
    

    function orderByPrice($limit, $offset, $search = '') {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE tieu_de LIKE :search ORDER BY gia LIMIT $limit OFFSET $offset";
        $params = [
            "search" => '%' . $search . '%',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Posts = [];
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

    function orderByPopular($limit,$offset,$search=''){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT bd.*, COUNT(ntdc.ma_bai_dang) AS so_luong_chon
                FROM bai_dang_ca_nhan AS bd
                LEFT JOIN nha_tuyen_dung_chon AS ntdc ON bd.ma_bai_dang = ntdc.ma_bai_dang
                WHERE bd.tieu_de LIKE :search
                GROUP BY bd.ma_bai_dang
                ORDER BY so_luong_chon DESC
                LIMIT $limit OFFSET $offset";
        $params = [
            "search" => '%' . $search . '%',
        ];
        $Posts = [];
        $result = self::db_get_list_condition($sql,$params);
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

    function getByFreeId($id) {
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE ma_nguoi_tim_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        $posts = []; 
    
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
                $posts[] = $Post;
            }
        }
        else{
            return [];
        }
        return $posts;
    }

    function getByFreeIdLimit($id,$limit,$offset) {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE ma_nguoi_tim_viec = :id LIMIT $limit OFFSET $offset";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        $posts = []; 
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
                $posts[] = $Post;
            }
        }
        else{
            return [];
        }
        return $posts;
    }

    function searchByTitle ($title, $limit, $offset){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM bai_dang_ca_nhan WHERE tieu_de LIKE :title LIMIT $limit OFFSET $offset";
        $params = [
            'title' => '%' . $title . '%',
        ];
        $result = self::db_get_list_condition($sql, $params);
        $posts = []; 
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
                $posts[] = $Post;
            }
        }
        else{
            return [];
        }
        return $posts;
    }

    function addPost($post){
        $sql = "INSERT INTO bai_dang_ca_nhan (ma_nguoi_tim_viec, tieu_de, noi_dung, gia, hinh_anh, ma_chuyen_nganh)
                VALUES(:freeId, :title, :content, :price, :img, :speId)";
        $params = [
            "freeId" => (int)$post->getFreeId(),
            "title" => $post->getTitle(),
            "content" => $post->getContent(),
            "price" => (float)$post->getPrice(),
            "img" => $post->getImg(),
            "speId" => (int)$post->getSpeId(),
        ];
        if (self::db_execute($sql, $params)){
            return true;
        }
        else{
            return false;
        }
    }

    function editPost($post) {
        $sql = "UPDATE bai_dang_ca_nhan 
                SET tieu_de = :title, 
                    noi_dung = :content, 
                    gia = :price, 
                    hinh_anh = :img, 
                    ma_chuyen_nganh = :speId
                WHERE ma_bai_dang = :postId";
        
        $params = [
            "title" => $post->getTitle(),
            "content" => $post->getContent(),
            "price" => (float)$post->getPrice(),
            "img" => $post->getImg(),
            "speId" => (int)$post->getSpeId(),
            "postId" => (int)$post->getPostId() 
        ];

        if (self::db_execute($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }
    
    function deletePost($id){
        $sql = "DELETE FROM bai_dang_ca_nhan WHERE ma_bai_dang = :id";
        $params = [
            "id" => (int)$id,
        ];
        if (self::db_execute($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }
}
?>