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
    
    function displayLimit($id){
        $id = (int)$id;
        $sql = "SELECT ntc.*
                FROM nha_tuyen_dung_chon ntc
                JOIN bai_dang_ca_nhan bdc ON ntc.ma_bai_dang = bdc.ma_bai_dang
                JOIN nguoi_tim_viec ntv ON bdc.ma_nguoi_tim_viec = ntv.ma_nguoi_tim_viec
                WHERE ntv.ma_nguoi_tim_viec = $id
                AND ntc.trang_thai = 'Đang chờ'";
        $Choices = [];
        $result = self::db_get_list($sql);
        if ($result){
            foreach ($result as $row){
                $choice = new EmployChoice();
                $choice->setId($row['ma_chon']);
                $choice->setCompanyId($row['ma_nha_tuyen_dung']);
                $choice->setPostId($row['ma_bai_dang']);
                $choice->setDate($row['ngay_chon']);
                $choice->setDesc($row['mo_ta']);
                $choice->setFile($row['file']);
                $choice->setPrice($row['gia']);
                $choice->setState($row['trang_thai']);
                $Choices[] = $choice;
            }
            return $Choices;
        }
        else{
            return [];
        }
    }

    function updateChoiceStatus($choiceId, $newStatus) {
        $choiceId = (int)$choiceId;
        $newStatus = htmlspecialchars($newStatus); 

        $sql = "UPDATE nha_tuyen_dung_chon
                SET trang_thai = :newStatus
                WHERE ma_chon = :choiceId";

        $params = [
            "choiceId" => $choiceId,
            "newStatus" => $newStatus,
        ];

        if (self::db_execute($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

}
?>