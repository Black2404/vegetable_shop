<!DOCTYPE html>
<html>
<head>
    <title>Rau củ Quả | Quản lý đơn hàng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
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
    <h2 class="text-center mb-4">Danh sách phản hồi</h2>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Ngày gửi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $fb)
            <tr>
                <td>{{ $fb->id }}</td>
                <td>{{ $fb->name }}</td>
                <td>{{ $fb->email }}</td>
                <td>{{ $fb->message }}</td>
                <td>{{ $fb->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.destroy', $fb->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Xóa phản hồi này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $feedbacks->withQueryString()->links() }}
    </div>
</div>
</body>
</html>
