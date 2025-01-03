<?php
$user = $userdb->getById($myId);
$order = Helper::input_value('order');
$state = '';
if ($order=='open'){
    $state = 'Đang tuyển';
}
else if ($order=='close'){
    $state = 'Đã đóng';
}
?>
<head>
    <title>danh sách công việc</title>
    <link rel="stylesheet" href="<?php echo Helper::get_url("user/public/css/job.css") ?>">
</head>
<body>
    <div id="danh_sach_cong_viec">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Danh sách công việc</h2>
                    <hr class="short"> <br>
                    <p class="text-danger fs-5">Hãy tìm và hoàn thành những công việc đang tìm kiếm người thực hiện!</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-9">
                <?php
                if ($user!== null && $user->getRole()=='nha_tuyen_dung'){
                ?>
                    <a href="?lay=addjob" class="btn btn-lg btn-primary ">Đăng công việc</a>
                <?php
                }
                ?>
                </div>
                <div class="col-3 text-end">
                    <div class="dropdown">
                        <button class="dropdown-toggle w-50" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background-color: white; color: black;">
                            Trạng thái
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?lay=job&order=open">Đang tuyển</a></li>
                            <li><a class="dropdown-item" href="?lay=job&order=close">Đã đóng</a></li>
                            <li><a class="dropdown-item" href="?lay=job&order=all">Tất cả</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <?php
        $job = new Job();
        $jobdb = new JobDatabase();
        $spedb = new SpecializedDb();
        $appdb = new ApplicantDatabase();
        
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $totalRows = $jobdb->countRow($state); 
        $totalPages = ceil($totalRows / $limit); 
        $listJob = $jobdb->GET_CVLimit($offset, $limit, $state);
     
        foreach ($listJob as $job) {
            $spe = $spedb->getById($job->getMaChuyenNganh());
            $speName = $spe->getSpeName();
            $appCount = $appdb->countForJob($job->getMaCongViec());
            $salary = number_format($job->getMucLuong(), 0, ',', '.');
        ?>
        <div class="container mt-2">
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
                    <span class="<?php if($job->getTrangThai()=='Đã đóng'){echo 'text-danger';}else{echo 'text-white';} ?>">Trạng thái: <?php echo $job->getTrangThai() ?></span>
                    <div class="Gia"><?php echo $salary ?>.000 VNĐ</div>
                    <a href="<?php echo Helper::get_url('user/index.php/?lay=jobdetail&id=') .  $job->getMaCongViec() ?>" id="changeContent" class="chaoGia">Chào giá cho dự án</a>
                </div>
            </div>
        </div>
        <?php
           
           }
        ?>
    </div> <br>
    <?php if ($totalPages > 1) { ?>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="?lay=job&order=<?php echo $order ?>&page=<?php echo max(1, $page - 1); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?lay=job&order=<?php echo $order ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="?lay=job&order=<?php echo $order ?>&page=<?php echo min($totalPages, $page + 1); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php } ?>

<script src="<?php echo Helper::get_url("user/public/js/job.js") ?>">
</script>