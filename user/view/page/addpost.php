<?php
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/addpoststyle.css') ?>">
    <script src="<?php echo Helper::get_url('user/public/js/addpost.js') ?>"></script>
    <title>Đăng bài</title>
</head>
<body>
    <div id="addpost">
        <div class="container mt-4">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <div class="row mt-4 text-center">
                                <div class="col-12">
                                    <h2>Đăng bài cá nhân</h2>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Tiêu đề</label> <br>
                                    <input type="text" placeholder="Nhập tiêu đề bài đăng" name="title">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Nội dung</label> <br>
                                    <textarea placeholder="Nhập nội dung chi tiết cho bài đăng" name="content"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Giá bắt đầu</label> <br>
                                    <input type="number" placeholder="Nhập giá thấp nhất" name="price">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="">Chuyên ngành</label> <br>
                                    <select name="speName" id="">
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
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <label for="fileToUpload">Ảnh minh họa</label> <br>
                                    <div class="image-container d-flex justify-content-center align-items-center mb-3">
                                        <img id="imagePreview" src="<?php echo Helper::get_url('user/public/img/default_image.png'); ?>" 
                                             class="card-img-top" height="250px" alt="Chọn file để hiển thị">
                                    </div>
                                    <input type="file" name="img" id="fileToUpload" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <div class="row text-center mt-4 mb-5">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success btn-lg">Đăng bài</button>
                                    <input type="hidden" name="action" value="add">
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
if (Helper::is_submit('add')) {
    $post = new Post();
    $postdb = new PostDatabase();
    $speName = Helper::input_value('speName');

    $spe = $spedb->getBySpeName($speName);
    
    $post->setFreeId(2);
    $post->setTitle(Helper::input_value('title'));
    $post->setContent(Helper::input_value('content'));
    $post->setPrice(Helper::input_value('price'));
    $post->setSpeId($spe->getSpeId());

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './public/img/';
        $uploadFile = $uploadDir . basename($_FILES['img']['name']);
        
        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
            $post->setImg(basename($_FILES['img']['name']));
        } else {
            throw new Exception("Lỗi khi tải file.");
        }
    } else {
        $post->setImg(''); 
    }

    $postdb->addPost($post);

    Helper::redirect("user/index.php");
}
ob_end_flush();
?>

