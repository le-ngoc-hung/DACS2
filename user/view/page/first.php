
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/first.css') ?>">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/job.css') ?>">
</head>
<body>
    <div class="container-fluid" id="background-image-div" style="margin-top:-50px;">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-6" id="content-index">
                <span >Tìm kiếm những Freelancer tài năng cùng với vô số dịch vụ về</span><br>
                <span id="text" style="border: none;"></span>
                <span class="blinking-cursor">|</span><br>
                <button id="troThanhFreelancer">Trở thành Freelancer</button>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div class="timKiemTrangChu">
                        <input type="hidden" name="lay" value="post">
                        <div class="bi bi-search" style="font-size: 20px; color: gray; align-items: center;"></div>
                        <input type="search" placeholder="Bạn đang tìm dịch vụ gì?" name="condition">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg mt-3">Tìm kiếm</button>
                </form>
            </div>
            <div class="col-5"></div>
        </div>
    </div>
    <div class="container py-5 mt-5 border border-3" style="background-color:whitesmoke;">
        <div class="text-center mb-4">
            <h2>Bạn là Freelancer có kỹ năng?</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-4 feature-box">
                <div class="feature-icon">
                    <i class="bi bi-upload"></i>
                </div>
                <h5>Đăng dịch vụ của bạn</h5>
                <p>Tạo tài khoản Freelancer, đăng dịch vụ với tiêu đề, nội dung, danh mục và thêm ảnh để bắt đầu nhận các đơn hàng mới từ khách hàng</p>
            </div>
            <div class="col-md-4 feature-box">
                <div class="feature-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h5>Nhận đơn hàng từ khách hàng</h5>
                <p>Nhận thông báo khi bạn có đơn hàng mới và sử dụng VietGigs để trao đổi với khách hàng, bắt đầu thực hiện đơn hàng</p>
            </div>
            <div class="col-md-4 feature-box">
                <div class="feature-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h5>Rút tiền khi hoàn thành</h5>
                <p>Sau khi đơn hàng hoàn tất và xác nhận bởi khách hàng, tạo yêu cầu rút tiền. VietGigs sẽ gửi khoản thanh toán ngay sau khi được xác nhận</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="?lay=login" class="btn-custom">Đăng ký làm Freelancer</a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Danh sách công việc</h2> <br>
                <hr style="height:5px; width:16%; background-color: orange; border: none; margin: auto;">
            </div>
        </div>
    </div>
    <?php
    $spedb = new SpecializedDb();
    $appdb = new ApplicantDatabase();
    $jobdb = new JobDatabase();
    $listJob = $jobdb->getJobsByStatus('Đang tuyển', 4);
    foreach ($listJob as $job) {
            $spe = $spedb->getById($job->getMaChuyenNganh());
            $speName = $spe->getSpeName();
            $appCount = $appdb->countForJob($job->getMaCongViec());
            $salary = number_format($job->getMucLuong(), 0, ',', '.');
        ?>
        <div class="container">
            <div class="row mt-3" id="thongTinSn">
                <div class="col-8 left">
                    <a href="#tenNganh" class="yellow"><?php echo $speName ?></a>
                    <br>
                    <a href="#TieuDe" class="tieuDe yellow"><?php echo $job->getTieuDeCongViec() ?></a><br>
                    <span class=" bi bi-pin-angle-fill chaoGia white">
                    <?php echo $appCount ?> Chào giá
                    </span> |
                    <span class=" bi bi-stopwatch thoiGianDangBai white">
                    <?php echo $job->getNgayTao() ?>
                    </span>
                    <p class="moTa grey">
                    <?php echo $job->getMoTaCongViec() ?>
                    </p>
                </div>
                <div class="col-4 right">
                    <span style="color: white">Trạng thái: <?php echo $job->getTrangThai() ?></span>
                    <div class="Gia"><?php echo $salary ?>.000 VNĐ</div>
                    <a href="<?php echo Helper::get_url('user/index.php/?lay=jobdetail&id=') .  $job->getMaCongViec() ?>" id="changeContent" class="chaoGia">Chào giá cho dự án</a>
                </div>
            </div>
        </div>
        <?php
           }
        ?>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="?lay=job" class="btn btn-lg btn-dark" style="color: yellow">Xem thêm</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Danh sách bài đăng</h2> <br>
                <hr style="height:5px; width:16%; background-color: orange; border: none; margin: auto;">
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="container">
                    <div class="row">
                        <?php
                        $freelancerdb = new FreelancerDatabase();
                        $postdb = new PostDatabase();
                        $list = $postdb->orderByLatest(8, 0, '');
                        foreach ($list as $post) {
                            $freelancer = $freelancerdb->getById($post->getFreeId());
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
                                            <a href="<?php echo Helper::get_url('user/index.php/?lay=profile&id=') . $freelancer->getFreeId() ?>">
                                                <img src="<?php echo Helper::get_url('user/public/img/') . $freelancer->getImg() ?>" alt="avatar" class="avt" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                                            </a>
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
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <a href="?lay=post" class="btn btn-lg btn-dark" style="color: yellow">Xem thêm</a>
                </div>
            </div>
        </div>
</body>
<script src="<?php echo Helper::get_url('user/public/js/first.js') ?>"></script>
</html>