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
        }
    }
    else{
        include_once 'view/page/postview.php';
    }
?>