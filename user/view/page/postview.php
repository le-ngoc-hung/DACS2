<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/poststyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <?php
        $condition = Helper::input_value('condition');
    ?>
    <div class="container-fluid" id="post">
        <div class="row"></div>
        <div class="row mt-5 mb-5">
            <div class="col-1"></div>
            <div class="col-1">
                <div class="line"></div>
            </div>
            <div class="col-7 txt">
                <div class="container">
                    <div class="row">
                        <div class="col-12 fs-5"><b>Danh sách các dịch vụ được đăng tải bởi các Freelancer</b></div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-muted">Tìm Freelancer phù hợp với nhu cầu của bạn, từ lập trình, thiết kế ảnh, viết content,...</div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="dropdown-toggle w-50" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sắp xếp
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=post&order=late&condition=') . $condition ?>">Mới nhất</a></li>
                        <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=post&order=popular&condition=') . $condition ?>">Bán chạy nhất</a></li>
                        <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=post&order=price&condition=') . $condition ?>">Giá tăng dần</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="container">
                    <div class="row">
                        <?php
                            $limit = 12;
                            if (!empty(Helper::input_value('page'))){
                                $page = (int)Helper::input_value('page');
                            }
                            else{
                                $page = 1;
                            }
                            $offset = ($page-1)*$limit;
                            $postdb = new PostDatabase();
                            $freelancer = new Freelancer();
                            $freedb = new FreelancerDatabase();
                            $totalRows = $postdb->countRow($condition);
                            $order = Helper::input_value('order');
                            switch ($order){
                                case 'late':
                                    $list = $postdb->orderByLatest($limit, $offset, $condition);
                                    break;
                                case 'price':
                                    $list = $postdb->orderByPrice($limit, $offset, $condition);
                                    break;
                                case 'popular':
                                    $list = $postdb->orderByPopular($limit, $offset, $condition);
                                    break;
                                default:
                                    $list = $postdb->displayLimit($limit, $offset, $condition);
                            }
                            $totalPages = ceil($totalRows/$limit);
                            foreach ($list as $post){
                            $freelancer = $freedb->getById($post->getFreeId());
                        ?>
                        <div class="col-3 py-2">
                            <div class="card">
                                <a href="<?php echo Helper::get_url('user/index.php/?lay=postdetail&id=') . $post->getPostId() ?>">
                                    <div class="image-container d-flex justify-content-center align-items-center">
                                        <div class="color-block"></div>
                                        <img src="<?php echo Helper::get_url('user/public/img/') . $post->getImg() ?>" class="card-img-top" height="250px" alt="Dịch thuật mọi văn bản">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title">
                                            <div class="d-flex flex-row">
                                                <a href=""><img src="<?php echo Helper::get_url('user/public/img/') . $freelancer->getImg() ?>" alt="aaaa" height="30px" class="avt"></a>
                                                <h6> &ensp; <?php echo $freelancer->getName() ?></h6>
                                            </div>                                                                       
                                         </p>
                                        <p class="card-text">
                                            <div class="truncate-multiline">
                                                <h5><?php echo $post->getTitle() ?></h5>
                                            </div>
                                            <hr>
                                            <div class="container text-end">
                                                <div class="row">
                                                    <div class="col-12">Giá bắt đầu từ</div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12"><h5><?php echo $post->getPrice() ?></h5></div>
                                                </div>
                                            </div> 
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <?php
    if ($totalPages>1){
    ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" 
                href="?lay=post&page=<?php echo max(1, $page - 1); ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" 
                href="?lay=post&page=<?php echo $i; ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" 
                href="?lay=post&page=<?php echo min($totalPages, $page + 1); ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php
    }
    ?>
</body>
</html>