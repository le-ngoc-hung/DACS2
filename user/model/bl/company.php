<?php
class Company{
    private $userId, $comId, $name, $des, $img;

    function __Construct(){

    }
    function getUserId(){
        return $this->userId;
    }
    function getComId(){
        return $this->comId;
    }
    function getName(){
        return $this->name;
    }
    function getDes(){
        return $this->des;
    }
    function getImg(){
        return $this->img;
    }

    function setUserId($userId){
        $this->userId = $userId;
    }
    function setComId($comId){
        $this->comId = $comId;
    }
    function setName($name){
        $this->name = $name;
    }
    function setDes($des){
        $this->des = $des;
    }
    function setImg($img){
        $this->img = $img;
    }
}
?>