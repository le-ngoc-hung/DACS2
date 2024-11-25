<?php
    $content = Helper::input_value('lay');
    if(!empty($content))
    {
        switch($content)
        {
            case "listuser":
                include_once 'view/page/listuser.php';
                break;
            case "postadmin":
                include_once 'view/page/postadmin.php';
                break;
            case "jobadmin":
                include_once 'view/page/jobadmin.php';
                break;
            case "editpost":
                include_once 'view/page/editpost.php';
                break;
            case "deletepost":
                include_once 'view/page/deletepost.php';
                break;
            case "editjob":
                include_once 'view/page/editjob.php';
                break;
            case "deletejob":
                include_once 'view/page/deletejob.php';
                break;
        }
    }
    else{
        include_once 'view/page/homeadmin.php';
    }
?>