<?php
class RateFreelancer{
    private $rateId, $freeId, $employId, $rate, $cmt, $date;

    function __construct(){

    }

    function getRateId(){
        return $this->rateId;
    }
    function getFreeId(){
        return $this->freeId;
    }
    function getEmployId(){
        return $this->employId;
    }
    function getRate(){
        return $this->rate;
    }
    function getCmt(){
        return $this->cmt;
    }
    function getDate(){
        return $this->date;
    }

    function setRateId($rateId){
        $this->rateId = $rateId;
    }
    function setFreeId($freeId){
        $this->freeId = $freeId;
    }
    function setEmployId($employId){
        $this->employId = $employId;
    }
    function setRate($rate){
        $this->rate = $rate;
    }
    function setCmt($cmt){
        $this->cmt = $cmt;
    }
    function setDate($date){
        $this->date = $date;
    }
}
?>