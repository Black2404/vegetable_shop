@php
    $cart = session('cart', ['items' => []]); // Giỏ hàng hiện tại
@endphp

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | {{ $product['name'] ?? 'Sản phẩm' }}</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Playfair Display', serif; background-color: #fff; padding-top: 80px; }
        .product-image { max-height: 450px; object-fit: cover; width: 100%; }
        .product-info h1 { color: #4b4b32; }
        .product-price { color: #b12704; font-size: 24px; }
        .btn-add-cart { background-color: #6d6a4b; color: #fff; }
        .btn-add-cart:hover { background-color: #575437; color: #fff; }
    </style>
</head>
<body>

@include('header')

<div class="container my-5">
    <div class="row g-5">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="{{ asset('images/' . ($product['image'] ?? 'no-image.jpg')) }}" 
                 alt="{{ $product['name'] ?? 'Sản phẩm' }}" class="product-image rounded shadow">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6 product-info">
            <h1>{{ $product['name'] ?? 'Sản phẩm' }}</h1>
            <p class="product-price">{{ number_format($product['price'] ?? 0) }} VNĐ</p>
            <p>{{ $product['description'] ?? 'Chưa có mô tả.' }}</p>

            <!-- Form thêm vào giỏ hàng -->
            @if($user) 
                <form action="{{ route('cart.add', $product['id'] ?? 0) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng:</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                            class="form-control" style="max-width:100px;">
                    </div>
                    <button type="submit" class="btn btn-add-cart">
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
            @else
                <div class="alert alert-warning mt-4" role="alert">
                    Vui lòng <a href="/login" class="alert-link">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.
                </div>
            @endif

            <!-- Đánh giá -->
            <div class="mt-5">
                <h4 class="mt-4">Đánh giá sản phẩm</h4>

                {{-- Hiển thị danh sách review --}}
                @foreach ($product['reviews'] ?? [] as $review)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $review['user']['name'] ?? 'Người dùng' }}</strong>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($review['created_at'])->format('d/m/Y H:i') ?? '' }}
                                </small>
                            </div>

                            {{-- Chỉ user chính chủ mới thấy nút Xóa --}}
                            @if($user && isset($review['user_id']) && $review['user_id'] == $user['id'])
                                <form action="{{ route('reviews.destroy', $review['id']) }}" method="POST" 
                                    onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này không?');" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            @endif
                        </div>

                        <div class="mb-2 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= ($review['rating'] ?? 0) ? 'bi-star-fill text-warning' : 'bi-star text-warning' }}"></i>
                            @endfor
                        </div>
                        <p class="mb-2">{{ $review['comment'] ?? '' }}</p>
                    </div>
                @endforeach


                {{-- Form gửi review --}}
                @if($user)
                    <form method="POST" action="{{ route('reviews.store', $product['id']) }}" class="mt-4">
                        @csrf
                        <div class="mb-2">
                            <label for="rating" class="form-label">Đánh giá sao:</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="">Chọn số sao</option>
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}">{{ $i }} sao</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2">
                            <textarea name="comment" class="form-control" placeholder="Viết đánh giá của bạn..." rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Gửi đánh giá</button>
                    </form>
                @else
                    <div class="alert alert-warning mt-4" role="alert">
                        Vui lòng <a href="{{ route('login') }}" class="alert-link">đăng nhập</a> để đánh giá sản phẩm.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
