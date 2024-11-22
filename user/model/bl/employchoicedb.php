<?php
class EmployChoiceDatabase extends Database{
    
    function addChoice($choice) {
        $sql = "INSERT INTO nha_tuyen_dung_chon (ma_nha_tuyen_dung, ma_bai_dang, mo_ta, file, gia)
                VALUES (:companyId, :postId, :desc, :file, :price)";
        $params = [
            "companyId" => (int)$choice->getCompanyId(),
            "postId" => (int)$choice->getPostId(),
            "desc" => $choice->getDesc(),
            "file" => $choice->getFile(),
            "price" => (float)$choice->getPrice(),
        ];
        if (self::db_execute($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>