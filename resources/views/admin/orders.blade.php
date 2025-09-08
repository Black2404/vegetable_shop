<!DOCTYPE html>
<html>
<head>
    <title>Rau củ Quả | Quản lý đơn hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Playfair Display', serif; padding-top: 80px; }
        h2 { text-align: center; color: #4b4b32; margin-bottom: 20px; margin-top: 20px;}
        table { background-color: white; }
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
    @include('admin/header')

<div class="container">
    <h2>Danh sách đơn hàng</h2>
    <table class="table table-bordered table">
        <thead class="table-light text-center align-middle">
            <tr>
                <th>ID</th>
                <th>Người mua</th>
                <th>Sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="text-center align-middle">{{ $order->id }}</td>
                <td class="text-center align-middle">{{ $order->user->name ?? 'N/A' }}</td>
                <td>
                    @foreach($order->items as $i)
                        {{ $i->product->name }} (x{{ $i->quantity }})@if(!$loop->last), @endif
                    @endforeach
                </td>
                <td class="text-center align-middle">{{ number_format($order->total) }}đ</td>
                <td class="text-center align-middle">{{ $order->status }}</td>
                <td class="text-center align-middle">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="text-center align-middle">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
</body>
</html>
