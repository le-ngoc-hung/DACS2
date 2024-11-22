<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/postadminstyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <div id="postadmin">
            <?php
            $condition = Helper::input_value('condition');
            ?>
            <div class="container">
                <div class="row"></div>
                <div class="row mt-5 mb-5">
                    <div class="col-1">
                        <div class="line"></div>
                    </div>
                    <div class="col-7 txt">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 fs-5"><b>Danh sách bài đăng của người tìm việc</b></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-muted">Tìm Freelancer phù hợp với nhu cầu của bạn, từ lập trình, thiết kế ảnh, viết content,...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown">
                            <button class="dropdown-toggle w-50" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Sắp xếp
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=postadmin&order=late&condition=') . $condition ?>">Mới nhất</a></li>
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=postadmin&order=popular&condition=') . $condition ?>">Bán chạy nhất</a></li>
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=postadmin&order=price&condition=') . $condition ?>">Giá tăng dần</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>        
            <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th style="width: 5%;">STT</th>
                <th style="width: 12%;">Tên người đăng</th>
                <th style="width: 15%;">Tiêu đề</th>
                <th style="width: 23%;">Nội dung</th>
                <th style="width: 10%;">Ngày đăng</th>
                <th style="width: 17%;">Hình ảnh</th>
                <th style="width: 11%;">Chuyên ngành</th>
                <th style="width: 8%;">Giá</th>
                <th style="width: 7%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $limit = 12;
            if (!empty(Helper::input_value('page'))){
                $page = (int)Helper::input_value('page');
            }
            else{
               $page = 1;
            }
            $offset = ($page-1)*$limit;
            $spedb = new Specializeddb();
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
            $stt=1;
            foreach ($list as $post){
                $freelancer = $freedb->getById($post->getFreeId());
            ?>
            <tr>
                <td><?php echo $stt; $stt++; ?></td>
                <td><?php echo $freelancer->getName() ?></td>
                <td><?php echo $post->getTitle() ?></td>
                <td><span><?php echo $post->getContent() ?></span></td>
                <td><?php echo date('d/m/Y', strtotime($post->getCreateDate())); ?></td>
                <td>
                    <div class="img-container">
                        <img src="<?php echo Helper::get_url('user/public/img/') . $post->getImg(); ?>" alt="Hình ảnh" width="200px">
                    </div>
                </td>
                <td><?php echo $spedb->getById($post->getSpeId())->getSpeName() ?></td>
                <td><?php echo $post->getPrice() ?></td>
                <td>
                    <a href="<?php echo "?lay=editpost&id=" . $post->getPostId() ?>" class="text-warning"><i class="bi bi-pen-fill"></i></a> <br> <br>
                    <a href="<?php echo "?lay=deletepost&id=" . $post->getPostId() ?>" class="text-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
            </table>
            <?php
            if ($totalPages>1){
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" 
                        href="?lay=postadmin&page=<?php echo max(1, $page - 1); ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                        aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" 
                        href="?lay=postadmin&page=<?php echo $i; ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" 
                        href="?lay=postadmin&page=<?php echo min($totalPages, $page + 1); ?><?php echo !empty($order) ? '&order=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                        aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
