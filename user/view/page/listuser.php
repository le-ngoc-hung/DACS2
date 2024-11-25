<?php
ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/listuserstyle.css') ?>">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <?php
            $condition = Helper::input_value('condition');
        ?>
        <div id="listuser">
            <div class="container">
                <div class="row"></div>
                <div class="row mt-5 mb-5">
                    <div class="col-1">
                        <div class="line"></div>
                    </div>
                    <div class="col-7 txt">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 fs-5"><b>Danh sách người dùng hệ thống</b></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-muted">Tìm Freelancer phù hợp với nhu cầu của bạn, từ lập trình, thiết kế ảnh, viết content,...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="dropdown">
                            <button class="dropdown-toggle w-50" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Vai trò
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=listuser&byrole=nguoitimviec&condition=') . $condition ?>">Người tìm việc</a></li>
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=listuser&byrole=nhatuyendung&condition=') . $condition ?>">Nhà tuyển dụng</a></li>
                                <li><a class="dropdown-item" href="<?php echo Helper::get_url('user/index.php/?lay=listuser&condition=') . $condition ?>">Tất cả</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>        
            <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th style="width: 5%;">STT</th>
                <th style="width: 15%;">Tên đăng nhập</th>
                <th style="width: 17%;">Email</th>
                <th style="width: 10%;">Ngày tạo</th>
                <th style="width: 20%;">Mô tả</th>
                <th style="width: 13%;">Vai trò</th>
                <th style="width: 15%;">Hình ảnh</th>
                <th style="width: 7%;"></th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $freelancer = new Freelancer();
                    $freelancerdb = new FreelancerDatabase();

                    $company = new Company();
                    $companydb = new CompanyDatabase();

                    
                    $user = new User();
                    $limit = 12;
                    if (!empty(Helper::input_value('page'))){
                        $page = (int)Helper::input_value('page');
                    }
                    else{
                        $page = 1;
                    }
                    $offset = ($page-1)*$limit;
                    $totalRows = 0;
                    $i = $offset + 1;
                    $order = Helper::input_value('byrole');
                    switch ($order){
                        case 'nguoitimviec':
                            $list = $userdb->getUserListByRole('nguoi_tim_viec',$condition, $limit, $offset);
                            $totalRows = $userdb->countRowByRole('nguoi_tim_viec',$condition);
                            break;
                        case 'nhatuyendung':
                            $list = $userdb->getUserListByRole('nha_tuyen_dung',$condition, $limit, $offset);
                            $totalRows = $userdb->countRowByRole('nha_tuyen_dung',$condition);
                            break;
                        default:
                            $list = $userdb->displayLimit($limit, $offset, $condition);
                            $totalRows = $userdb->countRow($condition);
                    }
                    $totalPages = ceil($totalRows/$limit);
                    
                    foreach ($list as $user){
                        if ($user->getRole()=='nguoi_tim_viec'){
                            $freelancer = $freelancerdb->getByUserId($user->getUserId());
                        }
                        else{
                            $company = $companydb->getByUserId($user->getUserId());
                        }
                ?>
            <tr>
                <td><?php echo $i; $i++; ?></td>
                <td><?php echo $user->getUserName() ?></td>
                <td><?php echo $user->getEmail() ?></td>
                <td><?php echo date('d/m/Y', strtotime($user->getCreateDate())) ?></td>
                <td>
                    <span>
                        <?php
                            if($user->getRole()=='nguoi_tim_viec'){
                                echo $freelancer->getBack();
                            }
                            else{
                                echo $company->getDes();
                            }
                        ?>
                    </span>
                </td>
                <td>
                    <?php
                        if ($user->getRole()=='nguoi_tim_viec'){
                            echo "Người tìm việc";
                        }
                        else{
                            echo "Nhà tuyển dụng";
                        }
                    ?>
                </td>
                <td>
                    <div class="img-container">
                        <?php
                            $img = '';
                            if($user->getRole()=='nguoi_tim_viec'){
                                $img = $freelancer->getImg();
                            }
                            else{
                                $img = $company->getImg();
                            }
                            if ($img!=''){
                        ?>
                        <img src="<?php echo Helper::get_url('user/public/img/') . $img?>" alt="Không có ảnh" width="150px" class="avt">
                        <?php
                            }
                        ?>
                    </div>
                </td>
                <td>
                    <a href="#" class="text-danger" onclick="showDeleteForm('<?php echo $user->getUserName(); ?>')">
                        <i class="bi bi-trash3-fill"></i>
                    </a>
                </td>
            </tr>
                <?php
                    }
                ?>
            </tbody>
            </table>
            <?php
            if ($totalPages>1){
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" 
                        href="?lay=listuser&page=<?php echo max(1, $page - 1); ?><?php echo !empty($order) ? '&byrole=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                        aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" 
                        href="?lay=listuser&page=<?php echo $i; ?><?php echo !empty($order) ? '&byrole=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" 
                        href="?lay=listuser&page=<?php echo min($totalPages, $page + 1); ?><?php echo !empty($order) ? '&byrole=' . $order : ''; ?><?php echo !empty($condition) ? '&condition=' . $condition : ''; ?>" 
                        aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php } ?>
        </div>
    </div>

    <div id="deleteOverlay" class="overlay">
        <div class="delete-form">
            <h4>Xác nhận xóa người dùng <span id="deleteUserName"></span>?</h4>
            <form method="POST" action="">
                <input type="hidden" name="username" id="usernameToDelete">
                <button type="submit" class="btn btn-danger">Xóa</button>
                <input type="hidden" name="action" value="deleteuser">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteForm()">Hủy</button>
            </form>
        </div>
    </div>

    <script>
        function showDeleteForm(userName) {
            document.getElementById('deleteUserName').innerText = userName;
            document.getElementById('usernameToDelete').value = userName;
            document.getElementById('deleteOverlay').style.display = 'flex';
        }
        function closeDeleteForm() {
            document.getElementById('deleteOverlay').style.display = 'none';
        }
    </script>
</body>
</html>
<?php
if (Helper::is_submit('deleteuser')){
    $userdelete = $userdb->getByUserName(Helper::input_value('username'));
    $userdb->deleteUserById($userdelete->getUserId());
    $page = isset($_GET['page']) ? $_GET['page'] : null;

    $url = Helper::get_url('user/index.php/?lay=listuser');

    if ($page) {
        $url .= '&page=' . $page;
    }
    header('Location: ' . $url);

    exit();
}
ob_end_flush();
?>
