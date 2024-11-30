<?php
ob_start(); 
?>
<head>
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/jobdetailstyle.css') ?>">
</head>
<body>
    
<?php
    
    $user1 = $userdb->getById($myId);
    $id = Helper::input_value('id');
    $job = new Job();
    $jobdb = new JobDatabase();
    $com = new Company();
    $comdb = new CompanyDatabase();
    $free = new Freelancer();
    $freedb = new FreelancerDatabase();
    $user = new User();
    $userdb = new UserDatabase();
    $applidb = new ApplicantDatabase();
    
    
    $job = $jobdb->display_by_id($id);
    
    $com = $comdb->getById($job->getMaNhaTuyenDung());
    $user = $userdb->getById($com->getUserId()); 
    
    
    $luong = number_format($job->getMucLuong());
    
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-0"></div>
            <div class="col-12">
                <div class="container" id="chiTietDuAn">
                    <div class="row">
                    <div class="col-md-8">  
                        <div class="hearChiTietDuAn">
                            <span>Chi tiết dự án</span>
                            <?php   
                            if ($user1==null){
                            ?>
                            <a href="?lay=login" class="btn text-dark" style="background-color:yellow;">Chào giá cho dự án</a>
                            <?php
                            } else if ($user1->getRole()=='nguoi_tim_viec'){
                            ?>
                            <btn class="btn text-dark" style="background-color:yellow;" onclick="openForm()">Chào giá cho dự án</btn>
                            <?php
                            } else if ($user->getUserId() == $user1->getUserId()){
                            ?>
                            <btn class="btn btn-success" onclick="openForm1()">Cập nhật thông tin dự án</btn>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="moTaDuAn">
                            <p><b>Mô tả</b></p>
                            <p class="noiDungMoTa"><?php echo $job->getMoTaCongViec() ?></p>   
                        </div>

                        <div class="thongTinKhachHang">
                            <p>Thông tin khách hàng</p>
                            <a href="<?php echo Helper::get_url('user/?lay=profilecompany&id=') . $job->getMaNhaTuyenDung() ?>" style="text-decoration: none;">
                                <img src="/DACS2/user/public/img/<?php echo $com->getImg()  ?>" width="5%" alt="" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"> &#160
                                <span class="tenKhachHang"><?php echo $user->getUserName() ?></span>
                            </a>
                        </div>
                        <div class="kiNang">
                            <p><b>Kỹ năng bắt buộc</b></p>
                            <div class="container-TAG">
                                <span><?php echo $job->getKyNangBatBuoc() ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="tomTatDuAn">
                        <table class="table table-striped" style=" margin-top:10px">
                            <thead>
                                <tr>
                                    <th colspan="2">Tóm tắt dự án</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ngân sách</td>
                                    <td><?php echo $luong ?>.000 VNĐ</td>
                                </tr>
                                <tr>
                                    <td>Chào giá</td>
                                    <td><?php echo $applidb->countForJob($job->getMaCongViec()) ?></td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td><?php echo $job->getTrangThai() ?></td>
                                </tr>
                                <tr>
                                    <td>Ngày Đăng</td>
                                    <td><?php echo $job->getNgayTao() ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-0"></div> <br>
        </div>
        <div class="row">
            <?php
                $list = $applidb->display_by_idJob($job->getMaCongViec());
                foreach ($list as $appli) {
                    $free = $freedb->getById($appli->getFreeID());
                
            ?>
            <div class="container mt-1" id="danh_sach_chao_gia">
                <div class="row" id="header_gui_chao_gia">
                    <div class="col-9">
                        <img src="/DACS2/user/public/img/<?php echo $free->getImg() ?>" width="5%" style="border-radius:50%; object-fit: cover;" alt="">
                        <span id="ten">&#160<?php echo $free->getName() ?></span>
                    </div>
                    <div class="col-3">
                        <span class="box_gia_va_thoi_gian">
                            <span class="gia_chao"><?php echo number_format($appli->getPrice(), 0, ',', '.') ?> VNĐ</span>
                            <span>&#160 / &#160</span>
                            <span class="so_ngay_hoan_thanh"><?php echo $appli->getDate() ?> ngày</span>
                        </span>
                    </div>
                </div>
                <div class="row" id="mo_ta_chao_gia">
                    <div class="p-3">
                        <?php echo $appli->getDesc() ?>
                    </div>
                </div>

                <div class="row" id="ngay_gio_chao_gia">
                    <div class="col-10"></div>
                    <div class="col-2">
                        <span class="bi bi-alarm"><?php echo $appli->getAppliDate() ?></span>                        
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div> <br>
    </div>
    <div class="overlay" id="formPrice">
        <div class="form-container">
            <span class="close-button" onclick="closeForm()">×</span>
            <h2>Chào Giá Dự Án</h2>
            <form id="chaoGiaForm" action="" method="POST">
                <div class="container">
                   <div class="row">
                        <div class="col-6"><label for="proposalAmount">Giá chào</label></div>
                        <div class="col-6"><input type="number" id="proposalAmount" name="GiaChao" required><br></div>
                   </div>
                </div>
                <div class="container">
                   <div class="row">
                        <div class="col-6"><label for="completionTime">Thời gian hoàn thành (ngày)</label></div>
                        <div class="col-6"><input type="number" id="completionTime" name="soNgayHoanThanh" required><br></div>     
                   </div>
                </div>

                <div class="container">
                   <div class="row">
                        <div class="col-4"><label for="proposalMessage">Lời nhắn</label><br></div>
                        <div class="col-8"><textarea class="p-4" id="proposalMessage" name="moTa" rows="4" required></textarea><br></div>     
                   </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-5"><button style="width:100%" type="submit">Gửi chào giá</button></div>
                        <div class="col-3"></div>
                        <input type="hidden" name="action" value="addappli">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="overlay mt-4" id="formUpdate">
        <div class="form-container">
            <span class="close-button" onclick="closeForm1()">×</span>
            <form action="" method="POST" style="max-width: 600px; margin: auto;">
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" id="title" name="titleUpdate" class="form-control" value="<?php echo $job->getTieuDeCongViec() ?>" required >
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea id="description" name="descriptionUpdate" rows="4" class="form-control" required><?php echo $job->getMoTaCongViec() ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Lương</label>
                    <input type="number" id="salary" name="salaryUpdate" class="form-control" min="0" value="<?php echo $job->getMucLuong() ?>" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="statusUpdate" class="form-select" required>
                        <option value="Đang tuyển" <?php echo $job->getTrangThai() === "Đang tuyển" ? "selected" : ""; ?>>Đang tuyển</option>
                        <option value="Đã hoàn thành" <?php echo $job->getTrangThai() === "Đã hoàn thành" ? "selected" : ""; ?>>Đã hoàn thành</option>
                        <option value="Đã đóng" <?php echo $job->getTrangThai() === "Đã đóng" ? "selected" : ""; ?>>Đã đóng</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="major" class="form-label">Chuyên ngành</label>
                    <select id="major" name="majorUpdate" class="form-select" required>
                    <?php
                        $spedb = new Specializeddb();
                        $spes = $spedb->displayAll(); 
                        foreach ($spes as $spe) {
                    ?>
                        <option value="<?php echo $spe->getSpeId() ?>" <?php if($spe->getSpeId()==$job->getMaChuyenNganh()){echo "selected";} ?>><?php echo $spe->getSpeName() ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="skills" class="form-label">Kỹ năng bắt buộc</label>
                    <input type="text" id="skills" name="skillsUpdate" class="form-control" value="<?php echo $job->getKyNangBatBuoc() ?>" placeholder="" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <input type="hidden" name="action" value="editjob">
                </div>
            </form>
        </div>
    </div>
    
</body>
<script src="<?php echo Helper::get_url("user/public/js/jobdetailjs.js") ?>"></script>
<?php
if (Helper::is_submit('addappli')){
    $free = $freedb->getByUserId($myId);
    $app = new Applicant();
    $app->setFreeId($free->getFreeId());
    $app->setPrice(Helper::input_value('GiaChao'));
    $app->setDate(Helper::input_value('soNgayHoanThanh'));
    $app->setDesc(Helper::input_value('moTa'));
    $app->setJobId(Helper::input_value('id'));
    $applidb->addAppli($app);

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}
if (Helper::is_submit('editjob')){
    $jobUpdate = $jobdb->display_by_id(Helper::input_value('id'));
    $jobUpdate->setTieuDeCongViec(Helper::input_value('titleUpdate'));
    $jobUpdate->setMoTaCongViec(Helper::input_value('descriptionUpdate'));
    $jobUpdate->setMucLuong(Helper::input_value('salaryUpdate'));
    $jobUpdate->setTrangThai(Helper::input_value('statusUpdate'));
    $jobUpdate->setMaChuyenNganh(Helper::input_value('majorUpdate'));
    $jobUpdate->setKyNangBatBuoc(Helper::input_value('skillsUpdate'));
    
    $jobdb->editJob($jobUpdate);

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}
ob_end_flush();
?>