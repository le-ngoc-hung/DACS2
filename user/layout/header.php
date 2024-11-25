<?php
$userdb = new UserDatabase();

if ($myId !== null) {
    $user = $userdb->getById($myId);
} 

$freedb = new FreelancerDatabase();
$companydb = new CompanyDatabase();
if (isset($_GET['logout'])) {
    session_unset();
    
    session_destroy();
    
    header("Location: index.php");
    exit(); 
}

$currentParams = $_GET;
unset($currentParams['condition']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/headerstyle.css') ?>">
    <title>Document</title>
</head>
<body>
<header>
    <div class="container-fluid" id="header">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <a href="<?php echo Helper::get_url('user/') ?>">
                    <img src="/live/mvc/views/resource/pictures/logo.png" alt="Logo" style="width:110px; height:auto;">
                </a>
            </div>
            <div class="col-md-3">
                <form onsubmit="searchRedirect(event)">
                    <div class="input-group">
                        <input type="text" id="textt" style="width: 85%;" placeholder="Tìm Kiếm!" name="condition">
                        <button type="submit" id="search">
                            <i class="bi bi-search" style="font-size: 18px;"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <div class="dropdown">
                    <span class="dropdown-toggle w-100" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Khám phá dịch vụ
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?lay=post">Dịch vụ từ Freelancer</a></li>
                        <li><a class="dropdown-item" href="?lay=job">Dự án tìm Freelancer</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 log">
                <?php
                if ($myId == null) {
                ?>
                <a href="<?php echo "?lay=intro" ?>">Trở thành Freelancer</a>
                <?php
                } else if ($user->getRole() == 'nguoi_tim_viec') {
                ?>
                <a href="<?php echo "?lay=infor" ?>">Thông tin Freelancer</a>
                <?php
                } else {
                ?>
                <a href="<?php echo "?lay=inforcompany" ?>">Thông tin Nhà tuyển dụng</a>
                <?php
                }
                ?>
            </div>
            <div class="col-md-1 mt-1"></div>
            <div class="col-md-2 log">
                <?php
                if ($myId == null) {
                ?>
                <a href="<?php echo "?lay=login" ?>">Đăng nhập</a>
                <div class="line"></div>
                <a href="<?php echo "?lay=register" ?>">Đăng kí</a>
                <?php
                } else if ($user->getRole() == 'nguoi_tim_viec') {
                    $free = $freedb->getByUserId($myId);
                    $avatar = Helper::get_url('user/public/img/') . $free->getImg(); 
                    $userName = $user->getUserName(); 
                ?>
                <div class="dropdown">
                    <span class="dropdown-toggle w-100" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $avatar ?>" alt="" class="avata" width=35px; height=35px;> <span class="text-white"><?php echo $userName ?></span>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=profile&id=') . $myId ?>">Trang cá nhân &ensp;</a></li>
                        <li><a class="dropdown-item" href="?logout=true">Đăng xuất &ensp;<i class="bi bi-box-arrow-right"></i></a></li>
                    </ul>
                </div>
                <?php
                } else {
                    $com = $companydb->getByUserId($myId);
                    $avatar = Helper::get_url('user/public/img/') . $com->getImg(); 
                    $userName = $user->getUserName(); 
                ?>
                <div class="dropdown">
                    <span class="dropdown-toggle w-100" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $avatar ?>" alt="" class="avata" width=35px; height=35px;> <span class="text-white"><?php echo $userName ?></span>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=profilecompany&id=') . $myId ?>">Trang cá nhân &ensp;</a></li>
                        <li><a class="dropdown-item" href="?logout=true">Đăng xuất &ensp;<i class="bi bi-box-arrow-right"></i></a></li>
                    </ul>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function searchRedirect(event) {
        event.preventDefault();
        const searchValue = document.getElementById("textt").value;
        const newUrl = window.location.origin + window.location.pathname + "?lay=post&condition=" + encodeURIComponent(searchValue);
        window.location.href = newUrl;
    }
</script>

</body>
</html>
