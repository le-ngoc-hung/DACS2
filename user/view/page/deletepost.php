<?php
ob_start(); 
$user = $userdb->getById($myId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/addpoststyle.css') ?>">
    <script src="<?php echo Helper::get_url('user/public/js/addpost.js') ?>"></script>
    <title>Document</title>
</head>
<body>
    <?php
    $post = new Post();
    $postdb = new PostDatabase();
    $post = $postdb->getById(Helper::input_value('id'));
    ?>
    <div id="addpost">
        <div class="container mt-4">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row mt-4 text-center">
                                <div class="col-12">
                                    <h2>Thông tin bài đăng cá nhân</h2>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Tiêu đề</label> <br>
                                    <input type="text" placeholder="Nhập tiêu đề bài đăng" value="<?php echo $post->getTitle() ?>" name="title" disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Nội dung</label> <br>
                                    <textarea placeholder="Nhập nội dung chi tiết cho bài đăng" name="content" disabled><?php echo $post->getContent() ?></textarea>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Giá bắt đầu</label> <br>
                                    <input type="number" placeholder="Nhập giá thấp nhất" value="<?php echo $post->getPrice() ?>" name="price" disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Chuyên ngành</label> <br>
                                    <select name="speName" id="" disabled>
                                        <?php
                                            $spedb = new Specializeddb();
                                            $spes = $spedb->displayAll();
                                            foreach ($spes as $spe) {
                                        ?>
                                        <option value="<?php echo $spe->getSpeName() ?>" <?php if($spe->getSpeId()==$post->getSpeId()){echo "selected";} ?>><?php echo $spe->getSpeName() ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Ảnh minh họa</label> <br>
                                    <div class="image-container d-flex justify-content-center align-items-center">
                                        <img src="<?php echo empty($post->getImg()) ? Helper::get_url('user/public/img/default_image.png') : Helper::get_url('user/public/img/') . $post->getImg(); ?>" class="card-img-top" height="250px" alt="Dịch thuật mọi văn bản" id="imagePreview">
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center mt-4 mb-5">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-lg">Xác nhận xóa</button>
                                    <a href="<?php if ($user->getRole()=='nguoi_tim_viec'){
                                        echo '?lay=profile&id=' . $post->getFreeId();
                                    }
                                    else{
                                        echo '?lay=postadmin&';
                                    } ?>" class="btn btn-secondary btn-lg">Hủy</a>
                                    <input type="hidden" name="action" value="delete">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (Helper::is_submit('delete')) {
    $postdb->deletePost($post->getPostId());
    if ($user->getRole()=='nguoi_tim_viec'){
        Helper::redirect('?lay=profile&id=' . $post->getFreeId());
    }
    else{
        Helper::redirect('?lay=postadmin');
    }
}
ob_end_flush();
?>