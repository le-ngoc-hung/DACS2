<?php
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/profile.css') ?>">
    <title>Document</title>
    <?php
    $freelancer = new Freelancer();
    $freedb = new FreelancerDatabase();

    $companydb = new CompanyDatabase();
    $user = new User();
    $userdb = new UserDatabase();

    $post = new Post();
    $postdb = new PostDatabase();

    $id = Helper::input_value('id');
    if (!empty($id)){
      $freelancer = $freedb->getById($id);
      $user = $userdb->getById($freelancer->getUserId());
      $datetime = $user->getCreateDate();

      $date = new DateTime($datetime);

      $year = $date->format('Y');
      $month = $date->format('m');
      $day = $date->format('d');

      $limit = 3;
      if (!empty(Helper::input_value('pagepost'))){
      $page = (int)Helper::input_value('pagepost');
      }
      else{
      $page = 1;
      }
      $offset = ($page-1)*$limit;
      $listPost = $postdb->getByFreeIdLimit($id,$limit,$offset);
      $totalPages = ceil($postdb->countRowById($id)/$limit);

      $applidb = new ApplicantDatabase();
      $totalPro = $applidb->countByFreeId($id);
    }
    ?>
</head>
<body>
    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 prof">
                <div class="d-flex flex-row mt-3 px-4">
                  <a href="<?php echo Helper::get_url('user/index.php/?lay=profile&id=') . $freelancer->getFreeId() ?>">
                    <img src="<?php echo Helper::get_url('user/public/img/') . $freelancer->getImg() ?>" alt="avatar" class="avt" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </a>
                    <div class="d-flex flex-column">
                        <h5 class="name"> &ensp; <?php echo $freelancer->getName() ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class="container" id="pro">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-4 profi1">
                <ul class="info">
                    <li><i class="bi bi-calendar-fill"></i> <?php echo 'Tham gia từ ngày ' . $day . ' tháng ' . $month . ' năm ' . $year ?></li>
                    <?php
                    if ($freelancer->getAddress()){
                    ?>
                    <li><i class="bi bi-flag-fill"></i> <?php echo $freelancer->getAddress() ?></li>
                    <?php
                    }
                    ?>
                    <li><i class="bi bi-briefcase-fill" style="color: brown;"></i> Dự án đã làm: <?php echo $totalPro ?></li>
                </ul>
                <hr>
                <ul class="contact">
                  <b>Liên hệ</b>
                  <a href=""><li><img src="<?php echo Helper::get_url('user/public/img/')  . 'gmail.png' ?>" height="18px"></img> Email</li></a>
                  <?php
                  if ($freelancer->getFacebook())
                  {
                  ?>
                  <a href="<?php echo $freelancer->getFacebook() ?>" target="_blank" style="color: blue;"><li><i class="bi bi-facebook"></i> Facebook</li></a>
                  <?php
                  }
                  ?>
                </ul>
                <hr>
            </div>
            <div class="col-6 mx-3">
              <div class="profi2">
                <?php
                if ($freelancer->getBack()){
                ?>
                <div class="intro">
                  <b>Giới thiệu</b>
                  <div class="text-box expandable" id="contentBox">
                    <?php echo nl2br($freelancer->getBack()) ?>
                  </div>
                  <span class="show-more mt-2 d-block" id="showMoreBtn">Hiện thêm</span>
                </div>
                <hr>
                <?php
                }
                ?>
                <?php
                  if ($listPost){
                ?>
                <div class="ser">
                  <b>Các dịch vụ </b>
                  <div class="detail">
                    <div class="container-fluid mt-3">
                    <?php
                      
                        foreach ($listPost as $post){
                          $createAt = $post->getCreateDate();
                          $dateStart = new DateTime($createAt);
                          $dateEnd = new DateTime(); 
                          $interval = $dateStart->diff($dateEnd);
                          $daysDifference = $interval->days;

                          $buy = $postdb->getBuy($post->getPostId());
                    ?>
                      <div class="row">
                        <div class="col-3">
                          <div class="image-container d-flex justify-content-center align-items-center">
                            <div class="color-block"></div>
                            <img src="<?php echo Helper::get_url('user/public/img/')  . $post->getImg() ?>" alt="">
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="title d-flex flex-column">
                            <div class="truncate-multiline">
                                <b><?php echo $post->getTitle() ?> </b>
                            </div>
                            <p class="text-muted">Lượt mua: <?php echo $buy ?></p>
                            <div class="time text-success d-flex align-items-end mt-auto">
                                <p>Đăng <?php echo $daysDifference ?> ngày trước</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="price d-flex flex-column">
                            <div class="text-center pricee">
                              <span>Giá bắt đầu từ</span>
                              <b><?php echo number_format($post->getPrice(), 0, ',', '.') ?> VND</b>
                            </div>
                            <div class="time text-success d-flex align-items-end mt-auto justify-content-center">
                              <a href="<?php echo "?lay=postdetail&id=" . $post->getPostId() ?>" class="btn btn-success text-white text-center w-100">Chi tiết</a>
                            </div>
                          </div>
                        </div>
                        <?php
                        $freelancer = $freedb->getById($id);
                        $userProfile = $userdb->getById($freelancer->getUserId());
                        $user = new User();
                        if (isset($myId)){
                          $user = $userdb->getById($myId);
                        }
                        if ($userProfile->getUserId()==$user->getUserId()){
                        ?>
                        <div class="col-1">
                          <a href="<?php echo "?lay=editpost&id=" . $post->getPostId() ?>" style="color: brown;"><i class="bi bi-pen-fill"></i></a> <br> <br>
                          <a href="<?php echo "?lay=deletepost&id=" . $post->getPostId() ?>" style="color: red;"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                        <?php
                        }
                        ?>
                      </div>
                      <hr style="width: 100%;">
                    <?php
                      }
                    ?>
                    <div class="row">
                      <div class="col-12">
                      
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                      <a class="page-link" href="<?php echo "?lay=profile&id=$id&pagepost=" . max(1, $page - 1); ?>" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                      <a class="page-link" href="<?php echo "?lay=profile&id=$id&pagepost=" . $i; ?>"><?php echo $i; ?></a>
                    </li>
                  <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                      <a class="page-link" href="<?php echo "?lay=profile&id=$id&pagepost=" . min($totalPages, $page + 1); ?>" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
                <hr>
                <?php
                  }
                ?>
                <div class="container">
                  <div class="row">
                    <?php
                    if ($freelancer->getExp()){
                      $exp = explode("\n", $freelancer->getExp());
                    ?>
                    <div class="col-6 exp">
                      <b>Kinh nghiệm làm việc</b>
                      <ul>
                        <?php
                        foreach ($exp as $ex){
                        ?>
                        <li class="skill-exp"><i class="bi bi-briefcase-fill"  style="color: brown;"></i> <?php echo $ex ?></li>
                        <?php
                        }
                        ?>
                      </ul>
                    </div>
                    <?php
                    }
                    ?>
                    <?php
                    if ($freelancer->getSkill()){
                      $skill = explode("\n", $freelancer->getSkill());
                    ?>
                    <div class="col-6 skill">
                        <b>Kỹ năng</b>
                        <ul>
                          <?php
                          foreach ($skill as $ski){
                          ?>
                          <li class="skill-exp"><i class="bi bi-check2"></i> <?php echo $ski ?></li>
                          <?php
                          }
                          ?>
                        </ul>
                    </div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo Helper::get_url('user/public/js/')  . 'profile.js' ?>"></script>
</html>