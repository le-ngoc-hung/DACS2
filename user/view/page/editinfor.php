<?php 
$freelancer = $freedb->getByUserId($myId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/editinfor.css') ?>">
    <title>Thông tin cá nhân</title>
</head>
<body>
    <div class="container" id="editinfor">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h3>Thông tin cá nhân</h3>
                </div>
            </div>
            <div class="row mb-3 mt-5">
                <div class="col-12 text-center">
                    <img id="preview" src="<?php echo Helper::get_url('user/public/img/') . $freelancer->getImg() ?>" alt="" height="200px" width="230px" style="margin-left:10px;"> 
                </div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="file" name="file" id="fileInput" accept=".jpg, .jpeg, .png" class="form-control">
                    <small class="text-muted mt-2 d-block">Chọn ảnh có định dạng .jpg, .jpeg, hoặc .png</small>
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-1"></div>
                <div class="col-5">
                    <label for=""><b>Tên</b></label>
                    <input type="text" name="name" value="<?php echo $freelancer->getName() ?>" style="margin-left:40px;">
                </div>
                
                <div class="col-5">
                    <label for=""><b>Facebook</b></label>
                    <input type="text" name="facebook" value="<?php echo $freelancer->getFacebook() ?>">
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-1"></div>
                <div class="col-5">
                    <label for=""><b>Địa chỉ</b></label>
                    <textarea name="address" style="margin-left:70px;"><?php echo $freelancer->getAddress() ?></textarea>
                </div>
                
                <div class="col-5">
                    <label for=""><b>Lý lịch</b></label>
                    <textarea name="back" style="margin-left:74px;"><?php echo $freelancer->getBack() ?></textarea>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-1"></div>
                <div class="col-5">
                    <label for=""><b>Kinh nghiệm</b></label>
                    <textarea name="exp" style="margin-left:70px;"><?php echo $freelancer->getExp() ?></textarea>
                </div>
                
                <div class="col-5">
                    <label for=""><b>Kĩ năng</b></label>
                    <textarea name="skill" style="margin-left:74px;"><?php echo $freelancer->getSkill() ?></textarea>
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success btn-lg">Cập nhật</button>
                    <input type="hidden" name="action" value="editinfor">
                </div>
            </div>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file); 
            }
        });
    </script>
</body>
</html>

<?php
if (isset($_POST['action']) && $_POST['action'] == 'editinfor') {
    $free = new Freelancer();
    $free->setFreeId($myId);
    $free->setName(Helper::input_value('name'));
    $free->setFacebook(Helper::input_value('facebook'));
    $free->setAddress(Helper::input_value('address'));
    $free->setBack(Helper::input_value('back'));
    $free->setExp(Helper::input_value('exp'));
    $free->setSkill(Helper::input_value('skill'));

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './public/img/';
        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . $fileName;

        if (!file_exists($filePath)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $free->setImg($fileName);
            } else {
                throw new Exception("Lỗi khi tải file.");
            }
        } else {
            $free->setImg($fileName);
        }
    } else {
        $free->setImg($freelancer->getImg());
    }
    $updated = $freedb->editFreelancer($free);

    if ($updated) {
        echo "<script>alert('Cập nhật thông tin thành công!'); window.location.href = ''; </script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra trong quá trình cập nhật.');</script>";
    }
}
?>
