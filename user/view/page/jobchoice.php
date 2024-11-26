<?php
ob_start();
$resultdb = new ResultDatabase();
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
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/jobchoicestyle.css') ?>">
    <title>Danh sách công việc</title>
    <script>
        function showForm(appliId) {
            document.getElementById("resultForm").style.display = "flex";
            document.querySelector('input[name="appliId"]').value = appliId; 
        }
        function hideForm() {
            document.getElementById("resultForm").style.display = "none";
        }
    </script>
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
                <?php foreach ($list as $appli): 
                    $job = $jobdb->display_by_id($appli->getJobId()); ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title"><b>Công việc:</b> <?php echo $job->getTieuDeCongViec(); ?></h5>
                            <p class="card-text">Mô tả: <?php echo $job->getMoTaCongViec(); ?></p>
                            <p class="card-text"><strong>Tình trạng:</strong> 
                                <?php echo $appli->getState() === 'Hoàn thành' ? 'Hoàn thành' : 'Đang thực hiện'; ?>
                            </p>
                        </div>
                        <button class="btn <?php echo $appli->getState() === 'Hoàn thành' ? 'btn-secondary' : 'btn-success'; ?>" 
                            <?php echo $appli->getState() === 'Hoàn thành' ? 'disabled' : 'onclick="showForm(' . $appli->getAppliId() . ')"'; ?>>
                            Hoàn thành
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class="overlay" id="resultForm" style="display:none;">
        <div class="form-container">
            <span class="close-button" onclick="hideForm()">×</span>
            <h3 class="form-title">Nộp Kết Quả Dự Án</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="resultDescription" class="form-label">Mô tả kết quả</label>
                    <textarea id="resultDescription" name="resultDescription" rows="4" class="form-control" placeholder="Nhập mô tả về kết quả công việc..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="attachment" class="form-label">File đính kèm</label>
                    <input type="file" id="attachment" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
                    <small class="form-text">Chấp nhận các định dạng: PDF, DOC, DOCX, JPG, PNG.</small>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Gửi Kết Quả</button>
                    <input type="hidden" name="action" value="submitResult">
                    <input type="hidden" name="appliId" value="">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if (Helper::is_submit('submitResult')) {
   
    $appliId = Helper::input_value('appliId');
    var_dump($appliId);
    $result = new Result();
    $applii = $appdb->getById($appliId);
    $result->setJobId($applii->getJobId()); 
    $result->setDesc(Helper::input_value('resultDescription'));
    $result->setFile($_FILES['attachment']['name']);

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './public/file/';
        $uploadFile = $uploadDir . basename($_FILES['attachment']['name']);
        
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
            $result->setFile(basename($_FILES['attachment']['name']));
        } else {
            throw new Exception("Lỗi khi tải file.");
        }
    } else {
        $result->setFile(''); 
    }
    $appdb->updateApplicationState($appliId, "Hoàn thành");
    
    $resultdb->addResult($result);
    echo "<script>alert('Gửi kết quả thành công!'); window.location.href = ''; </script>";
}
ob_end_flush();
?>
