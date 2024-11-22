<?php
session_start();
include_once './model/da/database.php';
include_once './model/da/helper.php';
include_once './model/bl/freelancer.php';
include_once './model/bl/freelancerdb.php';
include_once './model/bl/post.php';
include_once './model/bl/postdb.php';
include_once './model/bl/user.php';
include_once './model/bl/userdb.php';
include_once './model/bl/specialized.php';
include_once './model/bl/specializeddb.php';
include_once './model/bl/applicant.php';
include_once './model/bl/applicantdb.php';
include_once './model/bl/ratefreelancer.php';
include_once './model/bl/ratefreelancerdb.php';
include_once './model/bl/company.php';
include_once './model/bl/companydb.php';
include_once './model/bl/employchoice.php';
include_once './model/bl/employchoicedb.php';
include_once './model/bl/job.php';
include_once './model/bl/jobdb.php';

$db = new Database();

// Kiểm tra vai trò trong session
if (isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'quan_ly') {
    // Nhúng file admin nếu vai trò là quản lý
    include_once './view/common/admin.php';
} else {
    // Nhúng file user nếu không phải quản lý
    include_once './view/common/user.php';
}
?>
