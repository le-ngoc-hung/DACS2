<?php
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/buy.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container" id="buy">
        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
            <form method="post" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <h3>Mua dịch vụ</h3>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="">Mô tả công việc cần làm</label> <br>
                        <textarea placeholder="Nhập mô tả chi tiết" name="desc"></textarea>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="">File công việc chi tiết</label> <br>
                        <input type="file" name="file" id="">
                    </div>
                </div>
                <div class="row mt-2">
                    <label for="">Giá mong muốn</label> <br>
                    <input type="number" name="price" id="">
                </div>
                <div class="row text-center mt-4 mb-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-lg">Gửi yêu cầu</button>
                        <input type="hidden" name="action" value="buy">
                    </div>
                </div>
            </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>
</html>
<?php
if (Helper::is_submit('buy')){
    $choice = new EmployChoice();
    $choicedb = new EmployChoiceDatabase();
    
    $desc = Helper::input_value('desc');
    $price = Helper::input_value('price');
    $choice->setPostId(Helper::input_value('id'));
    $choice->setCompanyId(2);
    $choice->setDesc($desc);
    $choice->setPrice($price);

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        
        $uploadDir = './public/file/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $newFileName = uniqid() . '_' . basename($fileName);
        $uploadFilePath = $uploadDir . $newFileName;
        
        $allowedTypes = [
            'image/jpeg', 'image/png', 'application/pdf', 'application/zip',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        if (in_array($fileType, $allowedTypes)) {
            if ($fileSize <= 5 * 1024 * 1024) { 
                if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                    $choice->setFile($newFileName);
                    $choicedb->addChoice($choice);
                    Helper::redirect('?lay=postdetail&id=' . Helper::input_value('id'));
                } else {
                    $errorMessage = "Có lỗi khi tải lên tệp. Vui lòng thử lại.";
                }
            } else {
                $errorMessage = "Kích thước tệp không được vượt quá 5MB.";
            }
        } else {
            $errorMessage = "Chỉ cho phép tải lên hình ảnh, PDF, ZIP hoặc các tệp Word (.doc, .docx).";
        }
    } else {
        $choice->setFile('');
        $choicedb->addChoice($choice);
        Helper::redirect('?lay=postdetail&id=' . Helper::input_value('id'));
    }

    if (isset($errorMessage)) {
        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
    }
}
ob_end_flush();
?>

