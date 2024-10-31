<?php
class Post{
    private $postId, $freeId, $title, $content, $speId, $img, $price, $createDate;

    function __construct(){

    }

    function getPostId(){
        return $this->postId;
    }
    function getFreeId(){
        return $this->freeId;
    }
    function getTitle(){
        return $this->title;
    }
    function getContent(){
        return $this->content;
    }
    function getSpeId(){
        return $this->speId;
    }
    function getImg(){
        return $this->img;
    }
    function getPrice(){
        return $this->price;
    }
    function getCreateDate(){
        return $this->createDate;
    }

    function setPostId($postId){
        $this->postId = $postId;
    }
    function setFreeId($freeId){
        $this->freeId = $freeId;
    }
    function setTitle($title){
        $this->title = $title;
    }
    function setContent($content){
        $this->content = $content;
    }
    function setSpeId($speId){
        $this->speId = $speId;
    }
    function setImg($img){
        $this->img = $img;
    }
    function setPrice($price){
        $this->price = $price;
    }
    function setCreateDate($createDate){
        $this->createDate = $createDate;
    }
}
?>