<?php
class Freelancer{
    private $freeId, $userId, $name, $back, $skill, $exp, $img;

    function __construct(){

    }

    function getUserId(){
        return $this->userId;
    }
    function getName(){
        return $this->name;
    }
    function getFreeId(){
        return $this->freeId;
    }
    function getBack(){
        return $this->back;
    }
    function getSkill(){
        return $this->skill;
    }
    function getExp(){
        return $this->exp;
    }
    function getImg(){
        return $this->img;
    }

    function setUserId($userId){
        $this->userId=$userId;
    }
    function setName($name){
        $this->name=$name;
    }
    function setFreeId($freeId){
        $this->freeId=$freeId;
    }
    function setSkill($skill){
        $this->skill=$skill;
    }
    function setBack($back){
        $this->back=$back;
    }
    function setExp($exp){
        $this->exp=$exp;
    }
    function setImg($img){
        $this->img=$img;
    }
}
?>