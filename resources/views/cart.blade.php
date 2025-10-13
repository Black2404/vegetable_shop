<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | Giỏ hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap, Icons, Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #fff;
            padding-top: 80px;
        }
        .table th, .table td { vertical-align: middle; }
        .btn-outline-success {
            border-color: #6d6a4b; color: #6d6a4b;
        }
        .btn-outline-success:hover {
            background-color: #6d6a4b; color: white;
        }
        .btn-success {
            background-color: #6d6a4b; border-color: #6d6a4b;
        }
        .btn-success:hover {
            background-color: #5c5a42; border-color: #5c5a42;
        }
    </style>
</head>
<body>
@include('header')

<div class="container py-5">
    <h3 class="text-center mb-3" style="color: #4b4b32;">Giỏ hàng của bạn</h3>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(count($items) > 0)
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
            <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                @php
                    $product = $item['product'];
                    $subtotal = $product['price'] * $item['quantity'];
                @endphp
                <tr>
                    <td><img src="{{ asset('images/' . $product['image']) }}" width="70"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ number_format($product['price']) }} VNĐ</td>
                    <td style="width: 140px;">
                        <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control text-center"
                                   onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>{{ number_format($subtotal) }} VNĐ</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                <td colspan="2" class="fw-bold text-danger">{{ number_format($total) }} VNĐ</td>
            </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-start">
            <a href="/products" class="btn btn-outline-success"><i class="bi bi-arrow-left"></i> Tiếp tục mua sắm</a>

            <!-- Form thanh toán -->
            <form action="{{ route('cart.checkout') }}" method="POST" class="w-50 ms-3">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="{{ auth()->user()->address ?? '' }}"
                           placeholder="Nhập địa chỉ nhận hàng" required>
                    @error('address')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        Thanh toán <i class="bi bi-credit-card"></i>
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="text-center mt-4" style="margin-bottom: 50px">
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="/products" class="btn btn-outline-success">Mua sắm ngay</a>
        </div>
    @endif
</div>

@include('footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
