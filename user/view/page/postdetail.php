<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/postdetailstyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container" id="postdetail">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="container detail">
                    <?php
                        $user = new User();
                        if ($myId!==null){
                            $user = $userdb->getById($myId);
                        }
                        $id = Helper::input_value('id');
                        $postdb = new PostDatabase();
                        $post = new Post();
                        $freelancer = new Freelancer();
                        $freedb = new FreelancerDatabase();
                        $spe = new Specialized();
                        $spedb = new Specializeddb();
                        if (!empty($id)){
                            $post = $postdb->getById($id);
                            
                            $freelancer = $freedb->getById($post->getFreeId());

                            $spe = $spedb->getById($post->getSpeId());

                            $createAt = $post->getCreateDate();
                            $dateStart = new DateTime($createAt);
                            $dateEnd = new DateTime(); 
                            $interval = $dateStart->diff($dateEnd);
                            $daysDifference = $interval->days;

                            $buy = $postdb->getBuy($id);
                    ?>
                    <div class="row">
                        <div class="col-6">
                            <h2 class="text-success"><?php echo $post->getTitle() ?></h2> 
                            <div class="d-flex flex-row mt-3 mb-3">
                            <a href="<?php echo Helper::get_url('user/index.php/?lay=profile&id=') . $freelancer->getFreeId() ?>">
                                <img src="<?php echo Helper::get_url('user/public/img/') . $freelancer->getImg() ?>" alt="avatar" class="avt" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                            </a>
                                <a href="<?php echo Helper::get_url('user/index.php/?lay=profile&id=') . $freelancer->getFreeId() ?>"><h6> &ensp; <?php echo $freelancer->getName() ?></h6></a>
                                <div class="line"></div>
                                <p class="text-muted" id="buy"><?php echo "Lượt mua: " . $buy ?></p>
                                <div class="line"></div>
                                <a href="" class="badge badge bg-light text-muted" id="tag"><p><?php echo $spe->getSpeName() ?></p></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <img src="<?php echo Helper::get_url('user/public/img/') . $post->getImg() ?>" width="495px" alt="">
                            <hr>
                            <?php
                            if ($myId==null){
                            ?>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo Helper::get_url('user/index.php/?lay=login') ?>" class="btn btn-lg btn-success text-white">Mua dịch vụ</a>
                            </div>
                            <hr>
                            <?php
                            } else if ($user->getRole()=='nha_tuyen_dung'){
                            ?>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo Helper::get_url('user/index.php/?lay=buy&id=') . $id ?>" class="btn btn-lg btn-success text-white">Mua dịch vụ</a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Mô tả chi tiết</h5>
                                <h6 class="text-success"><?php echo "Đăng " . $daysDifference . " ngày trước" ?></h6>
                            </div>                            
                            
                            <hr>
                            <div>
                                <p class="des">&ensp; &ensp;<?php echo nl2br($post->getContent()) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    else{
                        echo "<h1>ERROR</h1>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>