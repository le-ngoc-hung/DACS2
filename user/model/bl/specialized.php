<?php
class Specialized{
    private $speId, $speName;

    function __construct(){

    }

    function getSpeId(){
        return $this->speId;
    }
    function getSpeName(){
        return $this->speName;
    }

    function setSpeId($speId){
        $this->speId = $speId;
    }
    function setSpeName($speName){
        $this->speName = $speName;
    }
}
?>