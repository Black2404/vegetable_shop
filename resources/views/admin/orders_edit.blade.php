<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Sửa đơn hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
@include('admin/header')

<div class="container mt-4">
    <h2 style="text-align: center; color: #4b4b32; margin-bottom: 20px; margin-top: 50px;">Sửa thông tin đơn hàng #{{ $order->id }}</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="Đã thanh toán" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                <option value="Đang xử lý" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="Hoàn thành" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="Đã hủy" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>
