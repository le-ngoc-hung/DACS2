<?php
    $content = Helper::input_value('lay');
    if(!empty($content))
    {
        switch($content)
        {
            case "intro":
                include_once 'view/page/intro.php';
                break;
            case "post":
                include_once 'view/page/postview.php';
                break;
            case "postdetail":
                include_once 'view/page/postdetail.php';
                break;
            case "profile":
                include_once 'view/page/profile.php';
                break;
            case "register":
                include_once 'view/page/register.php';
                break;
            case "login":
                include_once 'view/page/login.php';
                break;
            case "addpost":
                include_once 'view/page/addpost.php';
                break;
            case "editpost":
                include_once 'view/page/editpost.php';
                break;
            case "deletepost":
                include_once 'view/page/deletepost.php';
                break;
            case "buy":
                include_once 'view/page/buy.php';
                break;
            case "infor":
                include_once 'view/page/infor.php';
                break;
            case "profilecompany":
                include_once 'view/page/profilecompany.php';
                break;
            case "job":
                include_once 'view/page/seemorejob.php';
                break;
            case "jobdetail":
                include_once 'view/page/jobdetail.php';
                break;
            case "addjob":
                include_once 'view/page/addjob.php';
                break;
            case "inforcompany":
                include_once 'view/page/inforcompany.php';
                break;
        }
    }
    else{
        include_once 'view/page/postview.php';
    }
?>