<?php
$appdb = new ApplicantDatabase();
$list = $appdb->getByFreeId($myId);
$jobdb = new JobDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Danh sách công việc</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Danh sách công việc đã nhận</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10">
                <?php
                foreach($list as $appli){
                    $job = $jobdb->display_by_id($appli->getJobId()); 
                ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title"><b>Công việc:</b> <?php echo $job->getTieuDeCongViec() ?></h5>
                            <p class="card-text">Mô tả: <?php echo $job->getMoTaCongViec() ?></p>
                            <p class="card-text"><strong>Tình trạng:</strong> 
                            <?php if ($appli->getState() == 'Hoàn thành') {
                                echo 'Hoàn thành';
                            } else {
                                echo 'Đang thực hiện';
                            } ?>
                            </p>
                        </div>
                        <button class="btn <?php if ($appli->getState() == 'Hoàn thành') {echo 'btn-secondary'; } else {echo 'btn-success';} ?>" 
                        <?php if ($appli->getState() == 'Hoàn thành') {
                                echo 'disabled'; 
                            }
                        ?>
                        >
                            Hoàn thành
                        </button>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

</body>
</html>
