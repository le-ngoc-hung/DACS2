<?php
class EmployChoice{
    private $id, $companyId, $postId, $date, $desc, $file, $price, $state;

    function __construct(){

    }

    function getId(){
        return $this->id;
    }
    function getCompanyId(){
        return $this->companyId;
    }
    function getPostId(){
        return $this->postId;
    }
    function getDate(){
        return $this->date;
    }
    function getDesc(){
        return $this->desc;
    }
    function getFile(){
        return $this->file;
    }
    function getPrice(){
        return $this->price;
    }
    function getState(){
        return $this->state;
    }

    function setId($id){
        $this->id = $id;
    }
    function setCompanyId($companyId){
        $this->companyId = $companyId;
    }
    function setPostId($postId){
        $this->postId = $postId;
    }
    function setDate($date){
        $this->date = $date;
    }
    function setDesc($desc){
        $this->desc = $desc;
    }
    function setFile($file){
        $this->file = $file;
    }
    function setPrice($price){
        $this->price = $price;
    }
    function setState($state){
        $this->state = $state;
    }
}
?>