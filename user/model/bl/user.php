<?php
class User{
    private $userId, $userName, $pass, $email, $role, $createDate, $updateDate;

    function __construct(){

    }

    function getUserId(){
        return $this->userId;
    }
    function getUserName(){
        return $this->userName;
    }
    function getPass(){
        return $this->pass;
    }
    function getEmail(){
        return $this->email;
    }
    function getRole(){
        return $this->role;
    }
    function getCreateDate(){
        return $this->createDate;
    }
    function getUpdateDate(){
        return $this->updateDate;
    }

    function setUserId($userId){
        $this->userId=$userId;
    }
    function setUserName($userName){
        $this->userName=$userName;
    }
    function setPass($pass){
        $this->pass=$pass;
    }
    function setRole($role){
        $this->role=$role;
    }
    function setEmail($email){
        $this->email=$email;
    }
    function setCreateDate($createDate){
        $this->createDate=$createDate;
    }
    function setUpdateDate($updateDate){
        $this->updateDate=$updateDate;
    }
}
?>