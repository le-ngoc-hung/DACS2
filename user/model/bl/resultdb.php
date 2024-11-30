<?php
class ResultDatabase extends Database{
    public function addResult($result) {
        $sql = "INSERT INTO ket_qua_thuc_hien (ma_ung_tuyen, mo_ta, file) 
                VALUES (:appId, :desc, :file)";
        $params = [
            ':appId' => (int)$result->getAppId(),
            ':desc' => $result->getDesc(),
            ':file' => $result->getFile()
        ];

        return self::db_execute($sql, $params);
    }

    public function getAllResults($id) {
        $sql = "SELECT kq.* 
                FROM ket_qua_thuc_hien kq
                JOIN ung_tuyen ut ON kq.ma_ung_tuyen = ut.ma_ung_tuyen
                JOIN cong_viec cv ON ut.ma_cong_viec = cv.ma_cong_viec
                JOIN nha_tuyen_dung ntd ON cv.ma_nha_tuyen_dung = ntd.ma_nha_tuyen_dung
                WHERE ntd.ma_nha_tuyen_dung = :ma_nha_tuyen_dung;
                ";
        $params = [
            ":ma_nha_tuyen_dung" => (int)$id,
        ];
        $results = self::db_get_list_condition($sql, $params);
        
        $resultObjects = [];
        
        if ($results){
            foreach ($results as $row) {
                $result = new Result();
                $result->setResultId($row['ma_ket_qua_thuc_hien']);
                $result->setAppId($row['ma_ung_tuyen']); 
                $result->setDesc($row['mo_ta']); 
                $result->setFile($row['file']);
    
                $resultObjects[] = $result;
            }
            return $resultObjects;
        }
        else{
            return null;
        }
        
    }

}
?>