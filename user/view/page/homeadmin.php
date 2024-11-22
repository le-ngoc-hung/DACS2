<?php
$userdb = new UserDatabase();
$postdb = new PostDatabase();
$jobdb = new JobDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?php echo Helper::get_url('user/public/css/homeadminstyle.css') ?>">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid" id="homeadmin">
        <div class="row mb-4 mt-4">
            <div class="col-12 text-center">
                <h2>Tổng quan hệ thống</h2>
            </div>
        </div>
        <div class="row g-3 mt-3 mb-3">
            <div class="col-1"></div>
            <div class="col-5 p-3">
                <canvas id="myPieChart" class="pie-chart" width="200" height="300"></canvas>
                <script>
                    var ctx = document.getElementById('myPieChart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Người tìm việc', 'Nhà tuyển dụng', 'Quản lý'],
                            datasets: [{
                                label: 'Số lượng người dùng',
                                data: [
                                    <?php echo $userdb->countRowByRole('nguoi_tim_viec'); ?>, 
                                    <?php echo $userdb->countRowByRole('nha_tuyen_dung'); ?>,
                                    <?php echo $userdb->countRowByRole('quan_ly'); ?>
                                ],
                                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Thống kê Số lượng người dùng',  // Tiêu đề của biểu đồ
                                    font: {
                                        size: 20
                                    },
                                    padding: {
                                        top: 10,
                                        bottom: 30
                                    }
                                },
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="col-5 p-3">
            <canvas id="myLineChart" width="450" height="450"></canvas>
                <script>
                    var ctx = document.getElementById('myLineChart').getContext('2d');
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                            datasets: [
                                {
                                    label: 'Số bài đăng của người tìm việc',
                                    data: [
                                        <?php 
                                        for($i=1;$i<=12;$i++){
                                            echo $postdb->countByMonth($i);
                                            if ($i!=12){
                                                echo ",";
                                            }
                                        }
                                        ?>
                                    ], // Dữ liệu giả
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    fill: true,
                                    tension: 0.4,
                                    borderWidth: 2
                                },
                                {
                                    label: 'Số công việc của nhà tuyển dụng',
                                    data: [
                                        <?php 
                                        for($i=1;$i<=12;$i++){
                                            echo $jobdb->countByMonth($i);
                                            if ($i!=12){
                                                echo ",";
                                            }
                                        }
                                        ?>
                                    ], // Dữ liệu giả
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    fill: true,
                                    tension: 0.4,
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Thống kê số bài đăng và công việc theo từng tháng',
                                    font: { size: 20 },
                                },
                                legend: { position: 'top' },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }   
                    });
                </script>
            </div>
        </div>
    </div> <br>
</body>
</html>
