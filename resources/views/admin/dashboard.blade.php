<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            padding-top: 80px;
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: 500;
            color: #4b4b32;
        }
        .nav-link {
            color: #3c3c28 !important;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #7d7d52 !important;
        }
        .card-stat {
            background-color: #f2efec;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card-stat h4 {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #3c3c28;
        }
        .card-stat .value {
            font-size: 2rem;
            font-weight: bold;
            color: #4b4b32;
        }

    </style>
</head>
<body>
@include('admin/header')
<!-- Nội dung chính -->
<div class="container">
    <h2 class="mb-4 text-center" style="color: #3c3c28; margin-top: 50px; padding-bottom: 50px">📊 Thống kê tổng quan</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card-stat">
                <i class="bi bi-bag-check" style="font-size: 2rem;"></i>
                <h4>Đơn hàng</h4>
                <div class="value">{{ $totalOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-stat">
                <i class="bi bi-currency-dollar" style="font-size: 2rem;"></i>
                <h4>Doanh thu</h4>
                <div class="value">{{ number_format($totalRevenue) }}đ</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-stat">
                <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                <h4>Sản phẩm</h4>
                <div class="value">{{ $totalProducts }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-stat">
                <i class="bi bi-people" style="font-size: 2rem;"></i>
                <h4>Người dùng</h4>
                <div class="value">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
