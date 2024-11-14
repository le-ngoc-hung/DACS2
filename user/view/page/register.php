<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/register.css') ?>">
    <script src="<?php echo Helper::get_url('user/public/js/register.js') ?>"></script>
    <title>Document</title>
</head>
<body>
    <div class="container text-center p-3" id="register">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form action="">
                    <div class="row wel">
                        <b>Chào mừng đến với</b>
                        <a href=""><img src="<?php echo Helper::get_url('user/public/img/logo.jpg') ?>" alt="Logo" class="logo"></a>
                    </div>
                    <div class="row text-muted fs-5 mb-4"><p>Vui lòng đăng ký để tiếp tục</p></div>
                    <div class="row mb-1">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <input type="text" id="text" placeholder="Nhập họ tên đầy đủ của bạn">
                            <div class="icon"><i class="bi bi-person-circle">&ensp;</i></div>
                        </div>
                        <div id="tkdk" class="tb">Vui lòng không để trống</div>
                    </div>
                    <div class="row mb-1">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <input type="text" id="text" placeholder="Nhập địa chỉ Email">
                            <div class="icon"><i class="bi bi-envelope-at">&ensp;</i></div>
                        </div>
                        <div id="tkdk" class="tb">Email không hợp lệ</div>
                    </div>
                    <div class="row mb-1">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <input type="text" id="text" placeholder="Nhập số điện thoại">
                            <div class="icon"><i class="bi bi-phone">&ensp;</i></div>
                        </div>
                        <div id="tkdk" class="tb">Số điện thoại không hợp lệ</div>
                    </div>
                    <div class="row mb-1">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <input type="text" id="text" placeholder="Nhập họ tên đăng nhập của bạn">
                            <div class="icon"><i class="bi bi-people-fill">&ensp;</i></div>
                        </div>
                        <div id="tkdk" class="tb">Vui lòng không để trống</div>
                    </div>
                    <div class="row mb-4">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <input type="password" id="text" placeholder="Nhập mật khẩu">
                            <div class="icon"><i class="bi bi-lock-fill">&ensp;</i></div>
                        </div>
                        <div id="tkdk" class="tb">Mật khẩu ít nhất 6 kí tự</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3"></div>
                        <div class="col-3">
                            <label class="d-inline-block bor">
                                <input type="radio" name="choose" id=""> <br>Tôi là nhà tuyển dụng
                            </label>
                        </div>
                        <div class="col-3">
                            <label class="d-inline-block bor">
                                <input type="radio" name="choose" id=""> <br>Tôi là freelancer, muốn tìm việc
                            </label>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-success">
                                Tạo tài khoản
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <a href="">Bạn đã có tài khoản? Đăng nhập</a>
                    </div>
                    <div class="row"></div>
                </form>
            </div>
            <div class="col-4">
            </div>     
        </div>
    </div>
    
</body>
</html>