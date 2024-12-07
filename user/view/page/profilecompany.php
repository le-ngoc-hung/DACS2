<?php
$id = Helper::input_value('id');
$company = $companydb->getById($id);
if ($myId!==null){
    $company1 = $companydb->getByUserId($myId);
}
$jobdb = new JobDatabase();
$listJob = $jobdb->GET_CVLimitByCompanyId($company->getComId());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Company Profile</title>
</head>
<body>
<div class="container my-4">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 border border-2 border-primary p-5" style="box-shadow: 0 0 10px rgba(0,0,0,0.2);">
            <div class="text-center mb-4">
                <img src="<?php if($company->getImg()==''){echo "https://via.placeholder.com/150";} else{echo Helper::get_url('user/public/img/') . $company->getImg();} ?>" alt="Company Logo" class="rounded-circle mb-3" height="150px;" width="150px;">
                <h1 class="fw-bold"><?php echo $company->getName() ?></h1>
            </div>
            <hr>
            <div>
                <p class="mb-4 fs-5">
                    <strong>Mô tả công ty:</strong> <?php echo $company->getDes() ?>
                </p> <hr>
                <h2 class="h5 mb-3">Danh sách các dự án:</h2>
                <?php
                foreach ($listJob as $job){
                ?>
                <ul class="list-group mb-3">
                    <li class="list-group-item">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $job->getTieuDeCongViec() ?></h5>
                                <p class="card-text">
                                    <?php echo $job->getMoTaCongViec() ?>
                                </p>
                                <h6 class="card-subtitle mb-3 text-success">Mức lương: <?php echo $job->getMucLuong() . " VND" ?></h6>
                                <a href="<?php echo Helper::get_url('user/?lay=jobdetail&id=') . $job->getMaCongViec() ?>" class="btn btn-success">Xem chi tiết</a> &ensp;
                                <?php
                                if ($company1!==null && $company1->getComId()==$id){
                                ?>
                                <a href="" class="btn btn-danger">Xóa công việc</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>


</body>
</html>
