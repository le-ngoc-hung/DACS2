<?php
class Applicant{
    private $appliId, $freeId, $jobId, $state, $appliDate, $desc, $price, $date;

    function __construct(){

    }

    function getAppliID(){
        return $this->appliId;
    }
    function getFreeID(){
        return $this->freeId;
    }
    function getJobId(){
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
    function getPrice(){
        return $this->price;
    }
    function getDate(){
        return $this->date;
    }

    function setDate($date){
        $this->date = $date;
    }
    function setPrice($price){
        $this->price = $price;
    }
    function setAppliId($appliId){
        $this->appliId = $appliId;
    }
    function setFreeId($freeId){
        $this->freeId = $freeId;
    }
    function setJobId($jobId){
        $this->jobId = $jobId;
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