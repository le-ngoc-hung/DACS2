<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/register.css') ?>">
    <title>Login</title>
</head>
<body id="background-image-div">

    <div class="container text-center p-3" id="register">
        <div class="row mb-5"></div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form id="loginForm" action="<?php echo Helper::get_url('user/model/bl/xuLy_login.php') ?>" method="POST">
                    <div class="row wel">
                        <h1>Chào mừng đến với</h1>
                        <a href=""><img src="<?php echo Helper::get_url('user/public/img/logo.jpg') ?>" alt="Logo" class="logo"></a>
                    </div>
                    <div class="row fs-5 mb-4 "><h5>Vui lòng đăng nhập để tiếp tục</h5></div>
                    <div class="row mb-4">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <div class="icon"><i class="bi bi-people-fill">&ensp;</i></div>
                            <input type="text" id="username" name="username" placeholder="Nhập họ tên đăng nhập của bạn" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="input-group d-flex align-items-center justify-content-center">
                            <div class="icon"><i class="bi bi-lock-fill">&ensp;</i></div>
                            <input class="icon-input" type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
                            <i class="bi bi-eye eye-icon text-dark" onclick="togglePassword()"></i>
                        </div>
                    </div>
                    <div class="row mb-4">
                    <div class="input-group d-flex align-items-center justify-content-center text-sm ">
                        <i style="color:#ff5a5a;">
                            <?php
                                if (isset($_SESSION['error'])) {
                                    echo  $_SESSION['error'];
                                    unset($_SESSION['error']);
                                }
                            ?>
                        </i>
                    </div>
                    </div>
                    <div class="row mb-3">
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" id="loginButton">
                                Đăng nhập
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="<?php echo Helper::get_url('user/?lay=register')?>"> Đăng ký</a>
                    </div>
                    <div class="row"></div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</body>
<script src="<?php echo Helper::get_url("user/public/js/login.js")?>"></script>
</html>