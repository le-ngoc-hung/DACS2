<?php
if (isset($_GET['logout'])) {
    session_unset();
    
    session_destroy();
    
    header("Location: index.php");
    exit(); 
}
$userdb = new UserDatabase();

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
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/headeradminstyle.css') ?>">
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
            <div class="col-md-2">
                <form onsubmit="searchRedirect(event)">
                    <div class="input-group">
                        <input type="text" id="textt" style="width: 75%;" placeholder="Tìm Kiếm!" name="condition">
                        <button type="submit" id="search">
                            <i class="bi bi-search" style="font-size: 18px;"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-2 log">
                <a href="<?php echo "?lay=listuser" ?>">Quản lí người dùng</a>
            </div>
            <div class="col-md-2 log">
                <a href="<?php echo "?lay=postadmin" ?>">Quản lí bài đăng</a>
            </div>
            <div class="col-md-2 mt-1">
                <a href="<?php echo "?lay=jobadmin" ?>">Quản lí công việc</a>
            </div>
            <div class="col-md-2 log">
                <div class="dropdown">
                    <span class="dropdown-toggle w-100" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo Helper::get_url('user/public/img/j97.png') ?>" alt="" class="avata" width=35px; height=35px;> <span class="text-white">Ngọc Hùng</span>
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?logout=true">Đăng xuất &ensp;<i class="bi bi-box-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function searchRedirect(event) {
        event.preventDefault(); 
        const searchValue = document.getElementById("textt").value; 
        
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('condition', searchValue); 
        
        window.location.search = urlParams.toString();
    }
</script>

</body>
</html>
