<?php
$free = $freedb->getByUserId($myId);
$choicedb = new EmployChoiceDatabase();
$list = $choicedb->displayLimit($free->getFreeId());

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
        <hr>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10">
                <?php
                if (!empty($list)){
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
                            </div> <br>
                            <div class="text-center d-flex justify-content-center">
                                <form method="POST" action="">
                                    <input type="hidden" name="choiceId" value="<?php echo $choice->getId(); ?>">
                                    <button type="submit" class="btn btn-success" name="action" value="yes">Xác nhận</button>
                                </form>
                                &ensp;
                                <form method="POST" action="">
                                    <input type="hidden" name="choiceId" value="<?php echo $choice->getId(); ?>">
                                    <button  type="submit" class="btn btn-danger" name="action" value="no">Từ chối</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                ?>
                <h4 style="text-align:center;">Trống!</h4> <br>
                <?php
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && in_array($_POST['action'], ['yes', 'no'])) {
        $choiceId = $_POST['choiceId'];
        $action = $_POST['action'];

        if ($action == 'yes') {
            $choicedb->updateChoiceStatus($choiceId, 'Chấp nhận');
        } else if ($action == 'no') {
            $choicedb->updateChoiceStatus($choiceId, 'Từ chối');
        }

        echo "<script type='text/javascript'>
                window.location.href = window.location.href;
              </script>";
        exit();
    }
}
?>
