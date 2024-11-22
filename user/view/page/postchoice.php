<?php
$choicedb = new EmployChoiceDatabase();
$list = $choicedb->displayLimit(2);
$companydb = new CompanyDatabase();
$postdb = new PostDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Danh sách yêu cầu công việc</title>
</head>
<body>
    <div class="container mt-5" id="postchoice">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Danh sách yêu cầu công việc</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10">
                <?php
                foreach ($list as $choice){
                    $company = $companydb->getById($choice->getCompanyId());
                    $post = $postdb->getById($choice->getPostId());
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title"><?php echo $company->getName() ?> yêu cầu dịch vụ <?php echo $post->getTitle() ?></h5> <br>
                            <p class="card-text"><?php echo $choice->getDesc() ?></p>
                            <p class="card-text"><strong>Giá tiền:</strong> <?php echo $choice->getPrice() . " đ"?></p>
                            <p class="card-text">File đính kèm: <a href="<?php echo Helper::get_url('user/public/file/') . $choice->getFile() ?>" download class="link-primary">Tải xuống</a></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success">Xác nhận</button> &ensp;
                            <button class="btn btn-danger">Từ chối</button>
                        </div>
                        
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
