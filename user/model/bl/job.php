<?php
class Job {
    private $ma_cong_viec, $ma_nha_tuyen_dung, $tieu_de_cong_viec, $mo_ta_cong_viec, $muc_luong, $ngay_tao, $ma_chuyen_nganh, $trang_thai, $ky_nang_bat_buoc;

    function __construct() {
    }

    public function getMaCongViec() {
        return $this->ma_cong_viec;
    }

    public function setMaCongViec($ma_cong_viec) {
        $this->ma_cong_viec = $ma_cong_viec;
    }

    public function getMaNhaTuyenDung() {
        return $this->ma_nha_tuyen_dung;
    }

    public function setMaNhaTuyenDung($ma_nha_tuyen_dung) {
        $this->ma_nha_tuyen_dung = $ma_nha_tuyen_dung;
    }

    public function getTieuDeCongViec() {
        return $this->tieu_de_cong_viec;
    }

    public function setTieuDeCongViec($tieu_de_cong_viec) {
        $this->tieu_de_cong_viec = $tieu_de_cong_viec;
    }

    public function getMoTaCongViec() {
        return $this->mo_ta_cong_viec;
    }

    public function setMoTaCongViec($mo_ta_cong_viec) {
        $this->mo_ta_cong_viec = $mo_ta_cong_viec;
    }

    public function getMucLuong() {
        return $this->muc_luong;
    }

    public function setMucLuong($muc_luong) {
        $this->muc_luong = $muc_luong;
    }

    public function getNgayTao() {
        return $this->ngay_tao;
    }

    public function setNgayTao($ngay_tao) {
        $this->ngay_tao = $ngay_tao;
    }

    public function getMaChuyenNganh() {
        return $this->ma_chuyen_nganh;
    }

    public function setMaChuyenNganh($ma_chuyen_nganh) {
        $this->ma_chuyen_nganh = $ma_chuyen_nganh;
    }

    public function getTrangThai() {
        return $this->trang_thai;
    }

    public function setTrangThai($trang_thai) {
        $this->trang_thai = $trang_thai;
    }

    public function getKyNangBatBuoc() {
        return $this->ky_nang_bat_buoc;
    }

    public function setKyNangBatBuoc($ky_nang_bat_buoc) {
        $this->ky_nang_bat_buoc = $ky_nang_bat_buoc;
    }
}
?>