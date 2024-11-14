<?php
class CompanyDatabase extends Database{

    function getById($id){
        $sql = "SELECT * FROM nha_tuyen_dung WHERE ma_nha_tuyen_dung= :id";
        $params = [
            "id" => (int)$id,
        ];
        $result = self::db_get_row($sql, $params);
        if ($result){
            $com = new Company();
            $com->setUserId($result['ma_nguoi_dung']);
            $com->setComId($result['ma_nha_tuyen_dung']);
            $com->setName($result['ten_cong_ty']);
            $com->setDes($result['mo_ta_cong_ty']);
            $com->setImg($result['anh']);
            return $com;
        }
        else {
            return []; 
        }
    }
}
?>