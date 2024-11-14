<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/introstyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container" id="intro">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-7 intro">
                <br>
                <div class="chao">
                    <b>LÀM VIỆC PHÙ HỢP VỚI BẢN THÂN</b>
                    <h3>Đăng dịch vụ của bạn, chào giá dự án trên JobNet và kiếm thu nhập một cách dễ dàng</h3>
                </div> <br> <br> <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <h4>Lĩnh vực đa dạng</h4>
                            <ul>
                                <li>Lập trình</li>
                                <li>Thiết kế</li>
                                <li>Dịch thuật</li>
                                <li>Và nhiều lĩnh vực khác</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h4>Xây dựng sự nghiệp</h4>
                            <ul>
                                <li>Đăng ký nhanh chóng và tạo hồ sơ cá nhân</li>
                                <li>Nhận việc ngay hôm nay và khẳng định uy tín thông qua hệ thống đánh giá</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h4>Công cụ quản lý hiệu quả</h4>
                            <ul>
                                <li>Quản lý dự án và theo dõi tiến độ công việc</li>
                                <li>Giao tiếp hiệu quả với khách hàng</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <h4>Tham gia cộng đồng</h4>
                            <ul>
                                <li>Hãy tham gia JobNet ngay hôm nay để khám phá những cơ hội mới và bắt đầu hành trình thành công của bạn!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <img src="<?php echo Helper::get_url('user/public/img/') . "anhgioithieu.jpg" ?>" alt="" height="520px" width="330px" class="introimg">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row"></div>
        <div class="row mt-5 text-center">
            <div class="col-2"></div>
            <div class="col-8">
                <h3>Tham gia cộng đồng freelancer cùng với JobNet</h3>
            </div>
            <div class="col-2"></div>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="container">
                    <div class="row">
                            <?php
                                $freedb = new FreelancerDatabase();
                                $list = $freedb->display(4);
                                if (!empty($list)){
                                    foreach ($list as $fr)
                                    {
                            ?>
                                <div class="col-3">
                                    <div class="card">
                                        <img src="<?php echo Helper::get_url('user/public/img/')  . $fr->getImg() ?>" class="card-img-top" alt="...">
                                        <div class="card-body text-center">
                                            <h6 class="card-title"><?php echo $fr->getName() ?></h6>
                                            <p class="card-text"><?php echo $fr->getSkill() ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row"></div>
        <div class="row mt-5">
            <div class="col-1"></div>
            <div class="col-10 intro" style="border-right: 1px solid gray"> <br>
                <h3>Cách thức hoạt động</h3>
                <br>
                <div class="container">
                    <div class="row">
                            <div class="col-4">
                                <i class="bi bi-upload"></i> <br> <br>
                                <h4>Đăng một dịch vụ mới</h4>
                                <p>Đăng ký tài khoản của bạn, sau đó đăng dịch vụ và cung cấp dịch vụ của bạn cho khách hàng của JobNet.</p>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-arrow-up-right"></i> <br> <br>
                                <h4>Hoàn thành công việc</h4>
                                <p>Nhận thông báo khi bạn có đơn hàng mới và sử dụng hệ thống của JobNet để thảo luận chi tiết hơn với khách hàng.</p>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-cash"></i> <br> <br>
                                <h4>Nhận tiền dễ dàng</h4>
                                <p>Bạn chỉ cần tạo yêu cầu rút tiền. Khoản thanh toán sẽ được gửi cho bạn ngay sau khi VietGigs xác nhận.</p>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div> <br>
    <div class="container text-center">
        <div class="row">
            <p class="bi bi-person-workspace fs-1 text-success"></p>
        </div>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <h3>Trở thành Freelancer và đăng dịch vụ của bạn ngay hôm nay!</h3>
                <p class="fs-6">Hãy trở thành Freelancer hàng đầu trên nền tảng của chúng tôi và bắt đầu kiếm thêm nguồn thu nhập!</p> <br>
                <button type="submit" style="background-color: rgb(1, 142, 1); height:50px; width: 300px; color: white; font-size:18px; border: none; border-radius: 4px 4px 4px 4px;">
                    Bắt đầu trở thành freelancer <span class="bi bi-arrow-right"></span>
                </button>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>