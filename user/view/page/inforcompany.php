<?php
$company = $companydb->getByUserId($myId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 text-center border border-3 px-5 py-5">
                <h2>Thông tin nhà tuyển dụng</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 text-center">
                        <img id="imagePreview" 
                            src="<?php echo $company->getImg() ? Helper::get_url('user/public/img/') . $company->getImg() : 'https://via.placeholder.com/150'; ?>" 
                            alt="Company Logo" 
                            class="rounded-circle mb-3" 
                            height="150px;" 
                            width="150px;">
                    </div>
                    <div class="mb-3 text-center">
                        <input type="file" name="file" id="fileInput" accept=".jpg, .jpeg, .png" class="form-control">
                        <small class="text-muted mt-2 d-block">Chọn ảnh có định dạng .jpg, .jpeg, hoặc .png</small>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for=""><b>Tên</b></label>
                        <input type="text" name="name" value="<?php echo $company->getName() ?>" style="width:80%; margin-left:80px; padding:10px;">
                    </div>
                    <div class="mb-3 mt-4">
                        <label for=""><b>Mô tả</b></label>
                        <textarea name="des" id="" style="width:80%; margin-left:60px; height:120px; padding:10px;"><?php echo $company->getDes() ?></textarea>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-success btn-lg">Cập nhật thông tin</button>
                        <input type="hidden" name="action" value="editcom">
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>

<?php
if (isset($_POST['action']) && $_POST['action'] === 'editcom') {
    $name = $_POST['name'];
    $des = $_POST['des'];
    $img = $company->getImg(); 
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './public/img/';
        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . $fileName;

        if (!file_exists($filePath)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $img = $fileName; 
            } else {
                echo "<p class='alert alert-danger'>Lỗi khi tải file.</p>";
            }
        } else {
            $img = $fileName; 
        }
    }

    $company->setName($name);
    $company->setDes($des);
    $company->setImg($img);

    if ($companydb->editCompany($company)) {
        echo "<script>alert('Cập nhật thông tin thành công!'); window.location.href = ''; </script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra trong quá trình cập nhật.');</script>";
    }
}
?>
