<?php
class Applicant{
    private $appliId, $freeId, $jobId, $state, $appliDate, $desc;

    function __construct(){

    }

    function getAppliID(){
        return $this->appliId;
    }
    function getFreeID(){
        return $this->freeId;
    }
    function getJobID(){
        return $this->jobId;
    }
    function getState(){
        return $this->state;
    }
    function getAppliDate(){
        return $this->appliDate;
    }
    function getDesc(){
        return $this->desc;
    }

    function setAppliId($appliId){
        $this->appliId = $appliId;
    }
    function setFreeId($freeId){
        $this->freeId = $freeId;
    }
    function setJobpliId($jobpliId){
        $this->jobpliId = $jobpliId;
    }
    function setState($state){
        $this->state = $state;
    }
    function setAppliDate($appliDate){
        $this->appliDate = $appliDate;
    }
    function setDesc($desc){
        $this->desc = $desc;
    }
}
?>