<?php
class Specializeddb extends Database{

    function getById($id){
        $sql = "SELECT * FROM chuyen_nganh WHERE ma_chuyen_nganh = :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_list_condition($sql,$params);
        if ($result){
            foreach ($result as $row){
                $spe = new Specialized();
                $spe->setSpeId($row['ma_chuyen_nganh']);
                $spe->setSpeName($row['ten_chuyen_nganh']);
                return $spe;
            }
        }
        else{
            return null;
        }
    }
}
?>