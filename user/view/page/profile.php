<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/profilestyle.css') ?>">
    <title>Document</title>
    <?php
    $freelancer = new Freelancer();
    $freedb = new FreelancerDatabase();

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

      $limit = 4;
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

      $ratefreedb = new RateFreelancerDatabase();
      $totalRate = $ratefreedb->countRow($id);
      $rate1 = $ratefreedb->countByRate($id, 1);
      $rate2 = $ratefreedb->countByRate($id, 2);
      $rate3 = $ratefreedb->countByRate($id, 3);
      $rate4 = $ratefreedb->countByRate($id, 4);
      $rate5 = $ratefreedb->countByRate($id, 5);

      
      $rateDetail = $ratefreedb->displayLimit($id, 4, 0);
    }
    ?>
</head>
<body>
    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10 prof">
                <div class="d-flex flex-row mt-3 px-4">
                    <a href=""><img src="<?php echo Helper::get_url('user/public/img/')  . $freelancer->getImg() ?>" alt="aaaa" height="60px" class="avt"></a>
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
                    <li><i class="bi bi-briefcase-fill"></i> Dự án đã làm: <?php echo $totalPro ?></li>
                </ul>
                <hr>
                <ul class="contact">
                  <b>Liên hệ</b>
                  <a href=""><li><img src="<?php echo Helper::get_url('user/public/img/')  . 'gmail.png' ?>" height="18px"></img> Email</li></a>
                  <?php
                  if ($freelancer->getFacebook())
                  {
                  ?>
                  <a href="<?php echo $freelancer->getFacebook() ?>" target="_blank"><li><i class="bi bi-facebook"></i> Facebook</li></a>
                  <?php
                  }
                  ?>
                </ul>
                <hr>
                <div class="review-container">
                    <div class="stars text-center fs-3">
                      <span><?php echo $ratefreedb->getAvgRate($id) ?></span>
                      <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="summary">Dựa trên <?php echo $totalRate ?> nhận xét</div>
                    <div class="bar-container">
                      <span>5 sao</span>
                      <div class="bar">
                        <div class="bar-filled" style="<?php echo "width: " . ($rate5/$totalRate*100) . "%;" ?>"></div>
                      </div>
                      <span><?php echo $rate5 ?></span>
                    </div>
                    <div class="bar-container">
                      <span>4 sao</span>
                      <div class="bar">
                        <div class="bar-filled" style="<?php echo "width: " . ($rate4/$totalRate*100) . "%;" ?>"></div>
                      </div>
                      <span><?php echo $rate4 ?></span>
                    </div>
                    <div class="bar-container">
                      <span>3 sao</span>
                      <div class="bar">
                        <div class="bar-filled" style="<?php echo "width: " . ($rate3/$totalRate*100) . "%;" ?>"></div>
                      </div>
                      <span><?php echo $rate3 ?></span>
                    </div>
                    <div class="bar-container">
                      <span>2 sao</span>
                      <div class="bar">
                        <div class="bar-filled" style="<?php echo "width: " . ($rate2/$totalRate*100) . "%;" ?>"></div>
                      </div>
                      <span><?php echo $rate2 ?></span>
                    </div>
                    <div class="bar-container">
                      <span>1 sao</span>
                      <div class="bar">
                        <div class="bar-filled" style="<?php echo "width: " . ($rate1/$totalRate*100) . "%;" ?>"></div>
                      </div>
                      <span><?php echo $rate1 ?></span>
                    </div>
                </div>
                <div class="review-detail">
                  <b>Đánh giá chi tiết</b>
                  <?php
                    $companydb = new CompanyDatabase();
                    foreach ($rateDetail as $rate){
                      $com = $companydb->getById($rate->getEmployId());
                  ?>
                  <div class="aa mt-3">
                    <div class="re-detail d-flex">
                      <img src="<?php echo Helper::get_url('user/public/img/')  . $com->getImg() ?>" alt="aaa" height="50px" width="50px" class="avt">
                      <div class="name-star">
                        <b><?php echo $com->getName() ?></b>
                        <div class="stars" style="font-size: 18px;">
                          <?php
                            for ($i=1;$i<=$rate->getRate();$i++){
                          ?>
                          <i class="bi bi-star-fill"></i>
                          <?php
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="review-text">
                      <?php echo $rate->getCmt() ?>
                    </div>
                  </div>
                  <?php
                    }
                  ?>
                  
                </div>
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
                              <b><?php echo $post->getPrice() ?></b>
                            </div>
                            <div class="time text-success d-flex align-items-end mt-auto justify-content-center">
                                <button class="btn btn-success">Chi tiết</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-1">
                          <a href="<?php echo "?lay=editpost&id=" . $post->getPostId() ?>" style="color: brown;"><i class="bi bi-pen-fill"></i></a> <br> <br>
                          <a href="<?php echo "?lay=deletepost&id=" . $post->getPostId() ?>" style="color: red;"><i class="bi bi-trash3-fill"></i></a>
                        </div>
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
                        <li class="skill-exp"><i class="bi bi-briefcase-fill"></i> <?php echo $ex ?></li>
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