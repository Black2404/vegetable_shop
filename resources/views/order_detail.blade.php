<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Chi tiết đơn hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
@include('header')

<div class="container mt-4">
    <h2 style="text-align: center; color: #4b4b32; margin-bottom: 30px; margin-top: 20px;">
        Chi tiết đơn hàng #{{ $order['id'] }}
    </h2>

    <!-- Thông tin đơn hàng -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order['address'] }}</p>
            <p><strong>Trạng thái: </strong> {{ $order['status']}} </p>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">Danh sách sản phẩm</div>
        <div class="card-body p-0">
            <table class="table table-bordered text-center align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 12%">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th style="width: 15%">Giá</th>
                        <th style="width: 12%">Số lượng</th>
                        <th style="width: 15%">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order['items'] as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('images/' . $item['product']['image']) }}" 
                                 class="img-thumbnail rounded" width="70">
                        </td>
                        <td>{{ $item['product']['name'] }}</td>
                        <td>{{ number_format($item['price']) }} VNĐ</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td class="fw-bold text-danger">
                            {{ number_format($item['price'] * $item['quantity']) }} VNĐ
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <h5 class="fw-bold text-danger">
                Tổng cộng: {{ number_format($order['total']) }} VNĐ
            </h5>
        </div>
    </div>

    <!-- Nút quay lại -->
    <div class="d-flex justify-content-between mt-3" style=" margin-bottom: 20px">
        <a href="/orders" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@include('footer')
</body>
</html>
