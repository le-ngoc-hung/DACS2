<?php
ob_start(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Form Thêm Công Việc</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 border border-3 px-5 py-5">
                <h2 class="text-center">Thêm Công Việc</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề công việc</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề công việc" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả công việc</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi tiết công việc" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="salary" class="form-label">Mức lương</label>
                        <input type="number" class="form-control" id="salary" name="salary" placeholder="Nhập mức lương" required>
                    </div>

                    <div class="mb-3">
                        <label for="skills" class="form-label">Kỹ năng bắt buộc</label>
                        <input type="text" class="form-control" id="skills" name="skills" placeholder="Nhập kỹ năng yêu cầu" required>
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Chuyên ngành</label>
                        <select class="form-select" id="major" name="major" required>
                            <option value="" disabled selected>Chọn chuyên ngành</option>
                            <?php
                                $spedb = new Specializeddb();
                                $spes = $spedb->displayAll();
                                foreach ($spes as $spe) {
                            ?>
                            <option value="<?php echo $spe->getSpeName() ?>"><?php echo $spe->getSpeName() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3 mt-4 text-center">
                        <button type="submit" class="btn btn-primary">Thêm công việc</button>
                        <input type="hidden" name="action" value="addjob">
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>
<?php
if (Helper::is_submit('addjob')){
    $job = new Job();
    $jobdb = new JobDatabase();
    $job->setTieuDeCongViec(Helper::input_value('title'));
    $job->setMoTaCongViec(Helper::input_value('description'));
    $job->setMucLuong(Helper::input_value('salary'));
    $job->setKyNangBatBuoc(Helper::input_value('skills'));
    $speName = Helper::input_value('major');
    $spe = $spedb->getBySpeName($speName);
    $company = $companydb->getByUserId($myId);
    $job->setMaChuyenNganh($spe->getSpeId());
    $job->setMaNhaTuyenDung($company->getComId());

    $jobdb->addJob($job);

    Helper::redirect("?lay=job");
}
ob_end_flush();
?>