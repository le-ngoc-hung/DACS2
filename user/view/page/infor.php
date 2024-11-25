<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/infor.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-3 sidebar">
                <h5>Menu</h5>
                <ul>
                    <li><a href="?lay=infor&lay2=editinfor">Cập nhật thông tin</a></li>
                    <li><a href="?lay=infor&lay2=postchoice">Dịch vụ được mua</a></li>
                    <li><a href="?lay=infor&lay2=jobchoice">Dự án đã nhận</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-9 content">
                <div class="container">
                    <div class="row">
                        <?php
                            $choice = Helper::input_value('lay2');
                            if (!empty($choice)){
                                switch($choice){
                                    case "editinfor":
                                        include_once './view/page/editinfor.php';
                                        break;
                                    case "postchoice":
                                        include_once './view/page/postchoice.php';
                                        break;
                                    case "jobchoice":
                                        include_once './view/page/jobchoice.php';
                                        break;
                                }
                            }
                            else {
                                include_once './view/page/editinfor.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
