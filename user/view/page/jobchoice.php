<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Danh sách công việc</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Danh sách công việc đã nhận</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10">
                <!-- Công việc 1 -->
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Công việc: Thiết kế giao diện website</h5>
                            <p class="card-text">Mô tả: Thiết kế giao diện cho website bán hàng, đảm bảo tính thẩm mỹ và dễ sử dụng.</p>
                            <p class="card-text"><strong>Tình trạng:</strong> Đang xử lý</p>
                        </div>
                        <button class="btn btn-success">Hoàn thành</button>
                    </div>
                </div>
                <!-- Công việc 2 -->
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Công việc: Viết API cho ứng dụng</h5>
                            <p class="card-text">Mô tả: Tạo các API cần thiết để giao tiếp giữa front-end và back-end.</p>
                            <p class="card-text"><strong>Tình trạng:</strong> Chưa bắt đầu</p>
                        </div>
                        <button class="btn btn-success">Hoàn thành</button>
                    </div>
                </div>
                <!-- Công việc 3 -->
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Công việc: Kiểm thử hệ thống</h5>
                            <p class="card-text">Mô tả: Thực hiện kiểm thử để đảm bảo hệ thống hoạt động đúng và ổn định.</p>
                            <p class="card-text"><strong>Tình trạng:</strong> Đã hoàn thành</p>
                        </div>
                        <button class="btn btn-secondary" disabled>Hoàn thành</button>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

</body>
</html>
