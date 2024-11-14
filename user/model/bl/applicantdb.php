<?php
class ApplicantDatabase extends Database{

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
}
?>