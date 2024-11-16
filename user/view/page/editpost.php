<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/addpoststyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div id="addpost">
        <div class="container mt-4">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="">
                        <div class="container">
                            <div class="row mt-4 text-center">
                                <div class="col-12">
                                    <h2>Chỉnh sửa bài đăng cá nhân</h2>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Tiêu đề</label> <br>
                                    <input type="text" placeholder="Nhập tiêu đề bài đăng">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Nội dung</label> <br>
                                    <textarea placeholder="Nhập nội dung chi tiết cho bài đăng"></textarea>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Giá bắt đầu</label> <br>
                                    <input type="number" placeholder="Nhập giá thấp nhất">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Chuyên ngành</label> <br>
                                    <select name="" id="" placeholder="Nhập tiêu đề bài đăng">
                                        <option value="">Lập trình</option>
                                        <option value="">Dịch thuật</option>
                                        <option value="">Đào tạo</option>
                                        <option value="">Marketing</option>
                                        <option value="">Thiết kế</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Ảnh minh họa</label> <br>
                                    <div class="image-container d-flex justify-content-center align-items-center">
                                        <div class=""></div>
                                        <img src="<?php echo Helper::get_url('user/public/img/java_dev.png') ?>" class="card-img-top" height="250px" alt="Dịch thuật mọi văn bản">
                                    </div>
                                    <input type="file" name="" id="" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <div class="row text-center mt-4 mb-5">
                                <div class="col-12">
                                    <button class="btn btn-success btn-lg">Chỉnh sửa bài</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</body>
</html>