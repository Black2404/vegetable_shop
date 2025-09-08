<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | Sản phẩm</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px;
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
        .search-bar {
            max-width: 800px;
            margin: 0 auto 30px;
        }
        .filter-select {
            border-color: #6d6a4b;
            color: #4b4b32;
        }

        .pagination .page-link {
            color: #6d6a4b;
            border: 1px solid #6d6a4b;
            background-color: #fff;
        }
        .pagination .page-item.active .page-link {
            background-color: #6d6a4b;
            border-color: #6d6a4b;
            color: #fff;
        }
        .pagination .page-link:hover {
            background-color: #c7c6aa;
            color: #333;
        }
    </style>
</head>
<body>

    @include('header')

    <div class="container my-5">

        <h2 class="text-center mb-4" style="color: #4b4b32;">Tất cả sản phẩm</h2>

        <!-- BỘ LỌC THEO GIÁ & TÌM KIẾM -->
        <form action="{{ route('products.search') }}" method="GET" class="search-bar">
            <div class="row g-3 align-items-end justify-content-center">

                <!-- Từ khóa -->
                <div class="col-md-6">
                    <input 
                        type="text" 
                        name="keyword" 
                        class="form-control" 
                        style="background-color: white; border-color: #6d6a4b; color: #4b4b32;" 
                        placeholder="Tìm kiếm sản phẩm..." 
                        value="{{ request('keyword') }}">
                </div>

                <!-- Giá -->
                <div class="col-md-3">
                    <select name="price_range" class="form-select filter-select">
                        <option value="">-- Khoảng giá --</option>
                        <option value="1" {{ request('price_range') == '1' ? 'selected' : '' }}>Dưới 50.000đ</option>
                        <option value="2" {{ request('price_range') == '2' ? 'selected' : '' }}>50.000 - 100.000đ</option>
                        <option value="3" {{ request('price_range') == '3' ? 'selected' : '' }}>Trên 100.000đ</option>
                    </select>
                </div>

                <!-- Nút -->
                <div class="col-md-2">
                    <button type="submit" class="btn w-100" style="background-color: #6d6a4b; color: white;">
                        <i class="bi bi-search"></i> Tìm
                    </button>
                </div>
            </div>
        </form>

        <!-- DANH SÁCH SẢN PHẨM -->
        <div class="row g-4 mt-3">
            @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="card product-card h-100">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-danger">Giá: {{ number_format($product->price) }} VNĐ</p>
                            <a href="/product/{{ $product->id }}" class="btn btn-sm btn-success">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center mt-4">Không tìm thấy sản phẩm nào.</p>
            @endforelse
        </div>

        <!-- PHÂN TRANG -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
