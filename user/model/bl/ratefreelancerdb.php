<?php
class RateFreelancerDatabase extends Database{

    function countRow($id){
        $sql = "SELECT COUNT(*) as total FROM danh_gia_nguoi_tim_viec WHERE ma_nguoi_tim_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }

    function getAvgRate($id){
        $sql = "SELECT AVG(diem_danh_gia) as avg FROM danh_gia_nguoi_tim_viec WHERE ma_nguoi_tim_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $avg = $result['avg'];
        }
        return round($avg,1);
    }

    function countByRate($freeId,$rate){
        $sql = "SELECT COUNT(*) as total FROM `danh_gia_nguoi_tim_viec` WHERE ma_nguoi_tim_viec= :freeId and diem_danh_gia= :rate";
        $params = [
            "freeId" => (int)$freeId,
            "rate" =>(int)$rate,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }

    function displayLimit($id, $limit, $offset){
        $limit = (int)$limit;
        $offset = (int)$offset;
        $sql = "SELECT * FROM danh_gia_nguoi_tim_viec WHERE ma_nguoi_tim_viec= :id LIMIT $limit OFFSET $offset";
        $params = [
            "id" => (int)$id,
        ];
        $Rates = [];
        $result = self::db_get_list_condition($sql, $params);
        if ($result){
            foreach ($result as $row){
                $rate = new RateFreelancer();
                $rate->setRateId($row['ma_danh_gia']);
                $rate->setFreeId($row['ma_nguoi_tim_viec']);
                $rate->setEmployId($row['ma_nha_tuyen_dung']);
                $rate->setRate($row['diem_danh_gia']);
                $rate->setCmt($row['nhan_xet']);
                $rate->setDate($row['ngay_tao']);
                $Rates[] = $rate;
            }
        }
        else {
            return []; 
        }
        return $Rates;
    }
}
?>