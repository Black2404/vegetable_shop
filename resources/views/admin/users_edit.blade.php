<!DOCTYPE html>
<html>
<head>
    <title>Rau Củ Quả | Sửa người dùng</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Playfair Display', serif; padding-top: 80px; }
        h2 { text-align: center; color: #4b4b32; margin-bottom: 20px; margin-top: 50px }
    </style>
</head>
<body>
    @include('admin/header')

<div class="container">
    <h2>Sửa thông tin người dùng</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-select" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-success ">Cập nhật</button>
        </div>
    </form>
</div>
</body>
</html>
