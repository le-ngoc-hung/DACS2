<?php
class Result {
    // Thuộc tính
    private $resultId;
    private $appId;
    private $desc;
    private $file;

    public function __construct() {
    
    }

    public function getResultId() {
        return $this->resultId;
    }

    public function setResultId($resultId) {
        $this->resultId = $resultId;
    }

    public function getAppId() {
        return $this->appId;
    }

    public function setAppId($appId) {
        $this->appId = $appId;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }
}
?>
