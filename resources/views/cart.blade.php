<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | Giỏ hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap, Icons, Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-outline-success, .btn-outline-primary {
            border-color: #6d6a4b;
            color: #6d6a4b;
        }

        .btn-outline-success:hover, .btn-outline-primary:hover {
            background-color: #6d6a4b;
            color: white;
        }

        .btn-success {
            background-color: #6d6a4b;
            border-color: #6d6a4b;
        }

        .btn-success:hover {
            background-color: #5c5a42;
            border-color: #5c5a42;
        }
    </style>
</head>
<body>

@include('header')

<div class="container py-5">
    <h3 class="text-center mb-3" style="color: #4b4b32;">Giỏ hàng của bạn</h3>
    @if(Auth::check())
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card border-success">
                    <div class="card-body">
                        <label for="address" class="form-label fw-bold mb-2">Địa chỉ giao hàng:</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            class="form-control"
                            value="{{ old('address', Auth::user()->address) }}"
                            required
                            placeholder="Nhập địa chỉ nhận hàng..."
                            form="checkout-form"  <!-- Dòng này là quan trọng -->

                        <div id="address-error" class="text-danger mt-2" style="display: none;">Vui lòng nhập địa chỉ giao hàng.</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($cart && $cart->items->count() > 0)
    <form method="POST" action="{{ route('cart.update') }}">
        @csrf
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
                @php $total = 0; @endphp
                @foreach ($cart->items as $item)
                    @php
                        $product = $item->product;
                        $subtotal = $product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td><img src="{{ asset('images/' . $product->image) }}" width="70" height="70" style="object-fit: cover;"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }} VNĐ</td>
                        <td>
                            <input type="number" name="quantities[{{ $product->id }}]" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 80px; margin: auto;">
                        </td>
                        <td>{{ number_format($subtotal) }} VNĐ</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
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

        <div class="d-flex justify-content-between mt-3">
            <a href="/products" class="btn btn-outline-secondary">← Tiếp tục mua</a>
            <div>
                <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
                    <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">
                        <button type="submit" class="btn btn-success">Thanh toán</button>
                    </form>
            </div>
        </div>
    </form>
    @else
        <div class="text-center mt-4">
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="/products" class="btn btn-outline-success">Mua sắm ngay</a>
        </div>
    @endif
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>