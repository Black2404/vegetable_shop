<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | Đơn hàng của bạn</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Playfair Display', serif; 
            padding-top: 80px; 
            background-color: #f9f9f9; 
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4b4b32;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th { background-color: #f2f2f2; }

        /* Nút xem */
        .btn-outline-success {
            border-color: #6d6a4b;
            color: #6d6a4b;
        }
        .btn-outline-success:hover {
            background-color: #6d6a4b;
            color: #fff;
        }

        /* Phân trang */
    .simple-pagination {
        gap: 6px;
    }

    .simple-pagination .page-item {
        list-style: none;
    }

    .simple-pagination .page-link {
        border: 1px solid #6d6a4b;
        border-radius: 6px;
        color: #6d6a4b;
        background: #fff;
        font-weight: 600;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .simple-pagination .page-item.active .page-link {
        background-color: #6d6a4b;
        color: #fff;
    }

    .simple-pagination .page-link:hover {
        background-color: #c7c6aa;
        color: #333;
    }

</style>
</head>
<body>
    @include('header')

    <div class="container mt-4">
        <h2>Đơn hàng của bạn</h2>

        @if($orders->count() > 0)
            <table class="table table-bordered align-middle text-center shadow-sm bg-white rounded" style="margin-bottom: 30px;">
                <thead class="table-light">
                    <tr>
                        <th style="width:10%">Mã đơn</th>
                        <th style="width:20%">Ngày đặt</th>
                        <th style="width:20%">Tổng tiền</th>
                        <th style="width:20%">Trạng thái</th>
                        <th style="width:20%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order['id'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($order['total']) }} đ</td>
                        <td>{{ $order['status'] }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order['id']) }}" class="btn btn-sm btn-outline-success">
                                 Xem
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PHÂN TRANG --}}
            @if(!empty($pagination['last_page']) && $pagination['last_page'] > 1)
                <nav class="mt-4 d-flex justify-content-center">
                    <ul class="pagination simple-pagination">
                        @for ($i = 1; $i <= $pagination['last_page']; $i++)
                            <li class="page-item {{ ($pagination['current_page'] ?? 1) == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor
                    </ul>
                </nav>
            @endif
        @else
            <div class="alert alert-info text-center">
                Bạn chưa có đơn hàng nào.
            </div>
        @endif
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('footer')
</body>
</html>
