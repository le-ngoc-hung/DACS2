    <?php

    class JobDatabase extends Database{

        private $ma_cong_viec, $ma_nha_tuyen_dung, $tieu_de_cong_viec, $mo_ta_cong_viec, $muc_luong, $ngay_tao, $ma_chuyen_nganh, $trang_thai, $ky_nang_bat_buoc;
        
        
        public function GET_CVLimitByCompanyId($id){
            $id = (int)$id;
            $sql = "SELECT * FROM cong_viec WHERE ma_nha_tuyen_dung = $id";
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
        
        public function countRow($trangThai = '') {
            $sql = "SELECT COUNT(*) as total FROM cong_viec WHERE trang_thai LIKE :trangThai";
            $params = [
                ':trangThai' => '%' . $trangThai . '%'
            ];
        
            $result = self::db_get_row($sql, $params); 
            if ($result) {
                return (int)$result['total'];
            }
            return 0; 
        }
        

        public function GET_CVLimit($limit, $offset, $trangThai = '') {
            $limit = (int)$limit;
            $offset = (int)$offset;
            $sql = "SELECT * FROM cong_viec WHERE trang_thai LIKE :trangThai order by ma_cong_viec desc LIMIT $limit, $offset ";
        
            $Jobs = [];
            $params = [
                ':trangThai' => '%' . $trangThai . '%',
            ];
            $result = self::db_get_list_condition($sql, $params); 
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

        function addJob($job) {
            $sql = "INSERT INTO cong_viec (
                        ma_nha_tuyen_dung, 
                        tieu_de_cong_viec, 
                        mo_ta_cong_viec, 
                        muc_luong, 
                        ma_chuyen_nganh, 
                        ky_nang_bat_buoc
                    ) VALUES (
                        :ma_nha_tuyen_dung, 
                        :tieu_de_cong_viec, 
                        :mo_ta_cong_viec, 
                        :muc_luong, 
                        :ma_chuyen_nganh, 
                        :ky_nang_bat_buoc
                    )";
            $params = [
                "ma_nha_tuyen_dung" => (int)$job->getMaNhaTuyenDung(),
                "tieu_de_cong_viec" => $job->getTieuDeCongViec(),
                "mo_ta_cong_viec" => $job->getMoTaCongViec(),
                "muc_luong" => (float)$job->getMucLuong(),
                "ma_chuyen_nganh" => (int)$job->getMaChuyenNganh(),
                "ky_nang_bat_buoc" => $job->getKyNangBatBuoc(),
            ];
        
            if (self::db_execute($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
        function countByMonth($month, $year){
            $month = (int)$month;
            $year = (int)$year;
            $sql = "SELECT count(*) as total FROM cong_viec WHERE month(ngay_tao) = $month AND year(ngay_tao) = $year";
            $result = self::db_get_row($sql);
            $total = 0;
            if ($result){
                $total = $result['total'];
            }
            return $total;
        }
        
        function deleteJob($id) {
            $id = (int)$id;  
            
            $sql = "DELETE FROM cong_viec WHERE ma_cong_viec = :id";
            
            $params = [
                "id" => $id
            ];
            if (self::db_execute($sql, $params)) {
                return true; 
            } else {
                return false;
            }
        }
        

        function editJob($job) {
            $sql = "UPDATE cong_viec SET 
                        tieu_de_cong_viec = :tieu_de_cong_viec, 
                        mo_ta_cong_viec = :mo_ta_cong_viec, 
                        muc_luong = :muc_luong, 
                        ma_chuyen_nganh = :ma_chuyen_nganh, 
                        ky_nang_bat_buoc = :ky_nang_bat_buoc,
                        trang_thai = :trang_thai
                    WHERE ma_cong_viec = :ma_cong_viec";
            
            $params = [
                "ma_cong_viec" => (int)$job->getMaCongViec(),
                "trang_thai" => $job->getTrangThai(),
                "tieu_de_cong_viec" => $job->getTieuDeCongViec(),
                "mo_ta_cong_viec" => $job->getMoTaCongViec(),
                "muc_luong" => (float)$job->getMucLuong(),
                "ma_chuyen_nganh" => (int)$job->getMaChuyenNganh(),
                "ky_nang_bat_buoc" => $job->getKyNangBatBuoc(),
            ];
            
            if (self::db_execute($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
        
        public function getJobsByStatus($status = 'Đang tuyển', $limit = 4) {
            $limit = (int)$limit;
            $sql = "SELECT * FROM cong_viec WHERE trang_thai = :status LIMIT $limit";
            $Jobs = [];
            $params = [
                "status" => $status,
            ];

            $result = self::db_get_list_condition($sql, $params);
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
            
            return $Jobs;
        }
        
    }
    ?>