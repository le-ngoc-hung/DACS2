<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/editinfor.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container" id="editinfor">
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h3>Thông tin cá nhân</h3>
            </div>
        </div>
        <div class="row mb-3 mt-5">
            <div class="col-2"></div>
            <div class="col-10">
                <img id="preview" src="<?php echo Helper::get_url('user/public/img/j97.png'); ?>" alt="" height="150px" width="170px" style="margin-left:10px;"> 
                <input type="file" name="file" id="fileInput" accept=".jpg, .jpeg, .png">
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Tên</label>
                <input type="text" value="Lê Ngọc Hùng" name="name" style="margin-left:70px;">
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Facebook</label>
                <input type="text" value="hung123456" name="facebook" style="margin-left:10px;">
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Địa chỉ</label>
                <textarea name="address" id="" style="margin-left:47px;">Lý lịch về Lê Ngọc Hùng</textarea>
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Lý lịch</label>
                <textarea name="back" id="" style="margin-left:34px;">Kinh nghiệm làm việc của Lê Ngọc Hùng</textarea>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Kinh nghiệm</label>
                <textarea name="exp" id="" style="margin-left:7px;">Lý lịch về Lê Ngọc Hùng</textarea>
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <label for="">Kĩ năng</label>
                <textarea name="skill" id="" style="margin-left:24px;">Kinh nghiệm làm việc của Lê Ngọc Hùng</textarea>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success btn-lg">Cập nhật </button>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy file người dùng chọn
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result; // Gán URL hình ảnh vào src của thẻ img
                };
                reader.readAsDataURL(file); // Đọc file ảnh
            }
        });
    </script>
</body>
</html>
