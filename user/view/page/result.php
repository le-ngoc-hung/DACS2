<?php
$company = $companydb->getByUserId($myId);
$list = $resultdb->getAllResults($company->getComId());
$jobdb = new JobDatabase();
$appdb = new ApplicantDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách kết quả dự án đã giao</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h1 class="text-center text-primary mb-4">Danh sách kết quả dự án đã giao</h1>
    <hr> <br>
    <ul class="list-group">
        <?php
        if ($list){
            foreach ($list as $result){
                $appli = $appdb->getById($result->getAppId());
                $job = $jobdb->display_by_id($appli->getJobId());
                $free = $freedb->getById($appli->getFreeId());
        ?>
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark">Tên dự án: <?php echo $job->getTieuDeCongViec() ?></h5>
                    <p class="mb-0 text-muted">Người thực hiện: <?php echo $free->getName() ?></p>
                    <p class="mb-0 text-muted">Mức lương: <?php echo $appli->getPrice() ?> VND</p> 
                    <p class="mb-0 mt-2">Mô tả: <?php echo $result->getDesc() ?></p>
                </div>
                <a href="<?php echo Helper::get_url('user/public/file/') . $result->getFile() ?>" class="btn btn-primary" download>Tải file kết quả</a>
            </div>
        </li>
        <?php
            }
        }
        ?>
    </ul>
</div>
</body>
</html>
