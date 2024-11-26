<?php
class ResultDatabase extends Database{
    public function addResult($result) {
        $sql = "INSERT INTO ket_qua_thuc_hien (ma_cong_viec, mo_ta_ket_qua, file) 
                VALUES (:jobId, :desc, :file)";
        $params = [
            ':jobId' => (int)$result->getJobId(),
            ':desc' => $result->getDesc(),
            ':file' => $result->getFile()
        ];

        return self::db_execute($sql, $params);
    }
}
?>