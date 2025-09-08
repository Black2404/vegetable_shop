<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán thành công | Rau Củ Quả</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f6f4f1;
            font-family: 'Segoe UI', sans-serif;
        }

        .payment-wrapper {
            padding: 80px 15px;
        }

        .payment-box {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
            border: 1px solid #ddd;
        }

        .payment-icon {
            font-size: 64px;
            color: #6c947e;
        }

        .btn-shop {
            background-color: #6c947e;
            color: #fff;
        }

        .btn-shop:hover {
            background-color: #5a7f6b;
        }

        .thank-text {
            font-size: 18px;
            color: #4c4c4c;
        }

        footer {
            margin-top: 100px;
            padding: 30px;
            background-color: #e6e3dc;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="payment-wrapper text-center">
        <div class="payment-box">
            <div class="payment-icon mb-4">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="mb-3 text-success">Thanh toán thành công!</h2>
            <p class="thank-text">Cảm ơn bạn đã mua hàng tại cửa hàng <strong>Rau Củ Quả</strong>.</p>
            <p class="thank-text">Đơn hàng của bạn đang được xử lý.</p>
            <a href="/products" class="btn btn-shop mt-4">
                <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
            </a>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
