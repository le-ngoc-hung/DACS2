<?php

class JobDatabase extends Database{

    private $ma_cong_viec, $ma_nha_tuyen_dung, $tieu_de_cong_viec, $mo_ta_cong_viec, $muc_luong, $ngay_tao, $ma_chuyen_nganh, $trang_thai, $ky_nang_bat_buoc;
    
    
    function countRow(){
        $sql = "SELECT COUNT(*) as total FROM cong_viec";
        
        $result = self::db_get_row($sql);
        $total=0;
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }



    public function GET_CVLimit($limit,$offset){
        $limit=(int)$limit;
        $offset=(int)$offset;
        $sql = "SELECT * FROM cong_viec LIMIT $limit OFFSET $offset";
        $Jobs = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Job = new Job();
                $Job->setMaCongViec($row['ma_cong_viec']);
                $Job->setMaNhaTuyenDung($row['ma_nha_tuyen_dung']);
                $Job->setTieuDeCongViec($row['tieu_de_cong_viec']);
                $Job->setMoTaCongViec($row['mo_ta_cong_viec']);
                $Job->setMucLuong($row['muc_luong']);
                $Job->setNgayTao($row['ngay_tao']);
                $Job->setMaChuyenNganh($row['ma_chuyen_nganh']);
                $Job->setTrangThai($row['trang_thai']);
                $Job->setKyNangBatBuoc($row['ky_nang_bat_buoc']);
                $Jobs[] = $Job;
            }
        } 
        else {
            return []; 
        }
        return $Jobs;
    }

    
    function displayAll(){
        $sql = "SELECT * FROM cong_viec";
        $Jobs = [];
        $result = self::db_get_list($sql);
        if ($result) { 
            foreach ($result as $row) {
                $Job = new Job();
                $Job->setMaCongViec($row['ma_cong_viec']);
                $Job->setMaNhaTuyenDung($row['ma_nha_tuyen_dung']);
                $Job->setTieuDeCongViec($row['tieu_de_cong_viec']);
                $Job->setMoTaCongViec($row['mo_ta_cong_viec']);
                $Job->setMucLuong($row['muc_luong']);
                $Job->setNgayTao($row['ngay_tao']);
                $Job->setMaChuyenNganh($row['ma_chuyen_nganh']);
                $Job->setTrangThai($row['trang_thai']);
                $Job->setKyNangBatBuoc($row['ky_nang_bat_buoc']);
                $Jobs[] = $Job;
            }
        } 
        else {
            return []; 
        }
        return $Jobs;
    }


    function display_by_id($id){
        $sql = "SELECT * FROM cong_viec WHERE ma_cong_viec= :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $Job = new Job();
                $Job->setMaCongViec($result['ma_cong_viec']);
                $Job->setMaNhaTuyenDung($result['ma_nha_tuyen_dung']);
                $Job->setTieuDeCongViec($result['tieu_de_cong_viec']);
                $Job->setMoTaCongViec($result['mo_ta_cong_viec']);
                $Job->setMucLuong($result['muc_luong']);
                $Job->setNgayTao($result['ngay_tao']);
                $Job->setMaChuyenNganh($result['ma_chuyen_nganh']);
                $Job->setTrangThai($result['trang_thai']);
                $Job->setKyNangBatBuoc($result['ky_nang_bat_buoc']);
            return $Job;
        }
        else {
            return []; 
        }
    }

    function countByMonth($month){
        $month = (int)$month;
        $sql = "SELECT count(*) as total FROM cong_viec WHERE month(ngay_tao) = $month";
        $result = self::db_get_row($sql);
        $total = 0;
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }

      
}
?>