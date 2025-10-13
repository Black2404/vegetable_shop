<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap, Icon và Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px; 
        }
        .banner {
            background: url('/images/avt.jpg') no-repeat center center;
            background-size: cover;
            height: 580px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    @include('header')

    <!-- Banner -->
    <div class="banner"></div>

    <!-- Sản phẩm nổi bật -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
        <div class="row g-4">
            @if(!empty($products))
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card product-card h-100">
                            <img src="{{ asset('images/' . ($product['image'] ?? 'no-image.jpg')) }}" class="card-img-top" alt="{{ $product['name'] ?? 'Sản phẩm' }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['name'] ?? 'Sản phẩm' }}</h5>
                                <p class="card-text text-danger">Giá: {{ number_format($product['price'] ?? 0) }} VNĐ</p>
                                <a href="/product/{{ $product['id'] ?? '#' }}" class="btn btn-sm btn-success">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Chưa có sản phẩm nào.</p>
            @endif
        </div>
    </div>

    @include('chat')
    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
