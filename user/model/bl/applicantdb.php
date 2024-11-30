<?php
class ApplicantDatabase extends Database{

    public static function addAppli($appli){
    $sql = "INSERT INTO ung_tuyen (ma_nguoi_tim_viec, ma_cong_viec,  mo_ta, chao_gia, so_ngay_hoan_thanh)
            VALUES (:ma_nguoi_tim_viec, :ma_cong_viec, :mo_ta, :chao_gia, :so_ngay_hoan_thanh)";
    $params = [
        "ma_nguoi_tim_viec" => (int)$appli->getFreeId(),
        "ma_cong_viec" => (int)$appli->getJobId(),
        "mo_ta" => $appli->getDesc(),
        "chao_gia" => (float)$appli->getPrice(),
        "so_ngay_hoan_thanh" => (int)$appli->getDate()
    ];
    

    if (self::db_execute($sql, $params)) {
        return true; 
    } else {
        return false; 
    }
}

    

    function countByFreeId($id){
        $sql = "SELECT count(*) as total FROM ung_tuyen WHERE ma_nguoi_tim_viec = :id and trang_thai_ung_tuyen = 'Hoàn thành'";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        } 
        return $total;
    }
    function countForJob($id){
        $sql = "SELECT count(*) as total FROM ung_tuyen WHERE ma_cong_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $total = $result['total'];
        }
        return $total;
    }
    function display_by_idJob($id){
        $sql = "SELECT * FROM ung_tuyen WHERE ma_cong_viec = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Applis = [];
        if ($result){
            foreach ($result as $row) {
                $appli = new Applicant();
                $appli->setAppliId($row['ma_ung_tuyen']);
                $appli->setFreeId($row['ma_nguoi_tim_viec']);
                $appli->setJobId($row['ma_cong_viec']);
                $appli->setState($row['trang_thai_ung_tuyen']);
                $appli->setAppliDate($row['ngay_ung_tuyen']);
                $appli->setDesc($row['mo_ta']);
                $appli->setPrice($row['chao_gia']);
                $appli->setDate($row['so_ngay_hoan_thanh']);
                $Applis[]=$appli;
                
                
            }
        }else {
            return [];
        }
        return $Applis;
    }

    function getByFreeId($id){
        $sql = "SELECT * FROM ung_tuyen WHERE ma_nguoi_tim_viec = :id and (trang_thai_ung_tuyen = 'Chấp nhận' or trang_thai_ung_tuyen = 'Hoàn thành')";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql, $params);
        $Applis = [];
        if ($result){
            foreach ($result as $row) {
                $appli = new Applicant();
                $appli->setAppliId($row['ma_ung_tuyen']);
                $appli->setFreeId($row['ma_nguoi_tim_viec']);
                $appli->setJobId($row['ma_cong_viec']);
                $appli->setState($row['trang_thai_ung_tuyen']);
                $appli->setAppliDate($row['ngay_ung_tuyen']);
                $appli->setDesc($row['mo_ta']);
                $appli->setPrice($row['chao_gia']);
                $appli->setDate($row['so_ngay_hoan_thanh']);
                $Applis[]=$appli;
                
                
            }
        }else {
            return [];
        }
        return $Applis;
    }

    function getById($id){
        $sql = "SELECT * FROM ung_tuyen WHERE ma_ung_tuyen = :id";
        $params = [
            "id" => (int)$id,
        ];
        $row = self::db_get_row($sql, $params);
        if ($row) {
            $appli = new Applicant();
            $appli->setAppliId($row['ma_ung_tuyen']);
            $appli->setFreeId($row['ma_nguoi_tim_viec']);
            $appli->setJobId($row['ma_cong_viec']);
            $appli->setState($row['trang_thai_ung_tuyen']);
            $appli->setAppliDate($row['ngay_ung_tuyen']);
            $appli->setDesc($row['mo_ta']);
            $appli->setPrice($row['chao_gia']);
            $appli->setDate($row['so_ngay_hoan_thanh']);
            return $appli;
        }
        return null; 
    }
    
    function updateApplicationState($appliId, $state) {
        $sql = "UPDATE ung_tuyen SET trang_thai_ung_tuyen = :state WHERE ma_ung_tuyen = :appliId";
        $params = [
            "state" => $state,
            "appliId" => (int)$appliId
        ];

        return self::db_execute($sql, $params);
    }
}
?>