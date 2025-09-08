<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Quản lý người dùng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4b4b32;
        }
        table {
            background-color: white;
            border: 1px solid #ddd;
        }
        thead th {
            background-color: #f2efec;
            color: #4b4b32;
            text-align: center;
        }
        tbody td {
            vertical-align: middle;
            text-align: center;
        }
        .table-bordered th, .table-bordered td {
            border-color: #ddd;
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
    @include('admin/header')

<div class="container mt-4">
    <h2>Danh sách người dùng</h2>

    <!-- Form thêm người dùng -->
    <div class="card mb-4">
        <div class="card-header">Thêm người dùng</div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Tên" required>
                    </div>
                    <div class="col-md-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                    </div>
                    <div class="col-md-2">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success w-100">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bảng danh sách -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 d-flex justify-content-center">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

</body>
</html>
