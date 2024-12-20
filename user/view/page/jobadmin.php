<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/jobadminstyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <div id="jobadmin">
            <div class="container">
                <div class="row"></div>
                <div class="row mt-5 mb-5">
                    <div class="col-1">
                        <div class="line"></div>
                    </div>
                    <div class="col-7 txt">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 fs-5"><b>Danh sách công việc</b></div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-muted">Tìm Freelancer phù hợp với nhu cầu của bạn, từ lập trình, thiết kế ảnh, viết content,...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>        
            <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th style="width: 5%;">STT</th>
                <th style="width: 16%;">Tên Công ty</th>
                <th style="width: 18%;">Tiêu đề</th>
                <th style="width: 28%;">Nội dung</th>
                <th style="width: 10%;">Ngày tạo</th>
                <th style="width: 10%;">Giá</th>
                <th style="width: 10%;">Trạng thái</th>
                <th style="width: 7%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php
                $limit = 12;
                if (!empty(Helper::input_value('page'))){
                    $page = (int)Helper::input_value('page');
                }
                else{
                    $page = 1;
                }
                $offset = ($page-1)*$limit;
                $company = new Company();
                $companydb = new CompanyDatabase();
                $jobdb = new JobDatabase();
                $list = $jobdb->get_CVLimit($offset,$limit);
                $totalRows = $jobdb->countRow();
                $totalPages = ceil($totalRows/$limit);
                $i=1;
                foreach($list as $job){
                    $company = $companydb->getById($job->getMaNhaTuyenDung());
            ?>
            <tr>
                <td><?php echo $i; $i++; ?></td>
                <td><?php echo $company->getName() ?></td>
                <td><?php echo $job->getTieuDeCongViec() ?></td>
                <td><span><?php echo $job->getMoTaCongViec() ?></span></td>
                <td><?php echo date('d/m/Y', strtotime($job->getNgayTao())) ?></td>
                <td><?php echo $job->getMucLuong() . " đ" ?></td>
                <td>
                    <span class="<?php $trangThai = $job->getTrangThai();
                                        if ($trangThai=='Đang tuyển'){
                                            echo "text-success";
                                        }
                                        else if ($trangThai=='Đang tiến hành'){
                                            echo "text-muted";
                                        }
                                        else{
                                            echo "text-danger";
                                        } ?>">
                    <?php echo $trangThai ?></span>
                </td>
                <td>
                    <a href="<?php echo Helper::get_url('user/?lay=editjob&id=') . $job->getMaCongViec() ?>" class="text-warning"><i class="bi bi-pen-fill"></i></a> <br> <br>
                    <a href="<?php echo Helper::get_url('user/?lay=deletejob&id=') . $job->getMaCongViec() ?>" class="text-danger"><i class="bi bi-trash3-fill"></i></a>
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
                        href="?lay=jobadmin&page=<?php echo max(1, $page - 1); ?>" 
                        aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" 
                        href="?lay=jobadmin&page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" 
                        href="?lay=jobadmin&page=<?php echo min($totalPages, $page + 1); ?>" 
                        aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
