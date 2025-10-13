<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Rau Củ Quả | Thông tin cá nhân</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #ffffff;
            padding-top: 80px;
        }
        .profile-card {
            background-color: #f8f6f3;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 30px;
        }
        .profile-title {
            color: #4b4b32;
        }
        .info-label {
            color: #6d6a4b;
            font-weight: 500;
        }
        .btnn {
            text-align: center;
        }
    </style>
</head>
<body>

@include('header')

<div class="container py-5">
    <h3 class="text-center mb-4 profile-title">Thông tin cá nhân</h3>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Lỗi validate --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-card shadow">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="info-label">Họ tên:</label>
                <input type="text" name="name" value="{{ old('name', $user['name'] ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="info-label">Email:</label>
                <input type="email" value="{{ $user['email'] ?? '' }}" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label class="info-label">Địa chỉ:</label>
                <input type="text" name="address" value="{{ old('address', $user['address'] ?? '') }}" class="form-control">
            </div>

            <hr>

            <div class="mb-3">
                <label class="info-label">Mật khẩu mới (bỏ trống nếu không đổi):</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới (tùy chọn)">
            </div>

            <div class="mb-3">
                <label class="info-label">Xác nhận mật khẩu:</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
            </div>

            <div class="btnn mt-3">
                <button class="btn btn-success px-4" type="submit">Cập nhật thông tin</button>
            </div>
        </form>
    </div>
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
