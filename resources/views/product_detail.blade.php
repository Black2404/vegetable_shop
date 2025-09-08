<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | {{ $product->name }}</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px;
        }
        .product-image {
            max-height: 450px;
            object-fit: cover;
            width: 100%;
        }
        .product-info h1 {
            color: #4b4b32;
        }
        .product-price {
            color: #b12704;
            font-size: 24px;
        }
        .btn-add-cart {
            background-color: #6d6a4b;
            color: white;
        }
        .btn-add-cart:hover {
            background-color: #575437;
            color: white;
        }
    </style>
</head>
<body>

@include('header')

<div class="container my-5">
    <div class="row g-5">
        <!-- Ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="product-image rounded shadow">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6 product-info">
            <h1>{{ $product->name }}</h1>
            <p class="product-price">{{ number_format($product->price) }} VNĐ</p>
            <p>{{ $product->description }}</p>

        <!-- Thêm vào giỏ hàng -->
        @auth
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" style="max-width: 100px;">
                </div>
                <button type="submit" class="btn btn-add-cart">
                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                </button>
            </form>
        @else
            <div class="alert alert-warning mt-4" role="alert">
                Vui lòng <a href="{{ route('login') }}" class="alert-link">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.
            </div>
        @endauth


            <!-- ĐÁNH GIÁ -->
            <div class="mt-5">
                <h4>Đánh giá sản phẩm</h4>

                @forelse ($product->reviews as $review)
                    <div class="border rounded p-3 mb-3">
                        <strong>{{ $review->user->name }}</strong>
                        <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>

                        <!-- Nút xóa nếu là chủ sở hữu đánh giá -->
                        @if (auth()->check() && $review->user_id === auth()->id())
                            <form action="{{ route('review.delete', $review->id) }}" method="POST" class="d-inline float-end">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif

                        <div class="mb-2 mt-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-star text-warning"></i>
                                @endif
                            @endfor
                        </div>

                        <p class="mb-0">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p>Chưa có đánh giá nào.</p>
                @endforelse

                <!-- FORM GỬI ĐÁNH GIÁ -->
                @auth
                    <form action="{{ route('review.submit', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-2">
                            <label for="rating" class="form-label">Đánh giá sao:</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="">Chọn sao</option>
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
                @endauth
            </div>

        </div>
    </div>
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
