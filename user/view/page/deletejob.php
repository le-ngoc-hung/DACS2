<?php
ob_start(); 
$job = new Job();
$jobdb = new JobDatabase();
$job = $jobdb->display_by_id(Helper::input_value('id'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Chào Giá Dự Án</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 border border-3 p-5">
            <h2 style="text-align:center;">Chỉnh sửa dự án</h2>
            <form action="" method="POST" style="max-width: 600px; margin: auto;">
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" id="title" name="titleUpdate" class="form-control" value="<?php echo $job->getTieuDeCongViec() ?>" disabled >
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea id="description" name="descriptionUpdate" rows="4" class="form-control" disabled><?php echo $job->getMoTaCongViec() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Lương</label>
                    <input type="number" id="salary" name="salaryUpdate" class="form-control" min="0" value="<?php echo $job->getMucLuong() ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="statusUpdate" class="form-select" disabled>
                        <option value="Đang tuyển" <?php echo $job->getTrangThai() === "Đang tuyển" ? "selected" : ""; ?>>Đang tuyển</option>
                        <option value="Đã hoàn thành" <?php echo $job->getTrangThai() === "Đã hoàn thành" ? "selected" : ""; ?>>Đã hoàn thành</option>
                        <option value="Đã đóng" <?php echo $job->getTrangThai() === "Đã đóng" ? "selected" : ""; ?>>Đã đóng</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="major" class="form-label">Chuyên ngành</label>
                    <select id="major" name="majorUpdate" class="form-select" disabled>
                    <?php
                        $spedb = new Specializeddb();
                        $spes = $spedb->displayAll(); 
                        foreach ($spes as $spe) {
                    ?>
                        <option value="<?php echo $spe->getSpeId() ?>" <?php if($spe->getSpeId()==$job->getMaChuyenNganh()){echo "selected";} ?>><?php echo $spe->getSpeName() ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="skills" class="form-label">Kỹ năng bắt buộc</label>
                    <input type="text" id="skills" name="skillsUpdate" class="form-control" value="<?php echo $job->getKyNangBatBuoc() ?>" placeholder="" disabled>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                    <input type="hidden" name="action" value="deletejob">
                </div>
            </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>
<?php
if (Helper::is_submit('deletejob')){
    
    $jobdb->deleteJob(Helper::input_value('id'));

    Helper::redirect('?lay=jobadmin');
}
ob_end_flush();
?>
