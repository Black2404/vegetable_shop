<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
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
            padding-top: 100px;
        }

        .register-container {
            max-width: 500px;
            background-color: #f7f7f4;
            border: 1px solid #e0dfd5;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            margin-bottom: 50px;
        }

        .btn-register {
            background-color: #6d6a4b;
            color: white;
        }

        .btn-register:hover {
            background-color: #575536;
        }
    </style>
</head>
<body>

    @include('header')

    <div class="container">
        <div class="register-container mx-auto mt-5">
            <h3 class="text-center mb-4" style="color:#4b4b32;">Tạo tài khoản mới</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên:</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        id="name" 
                        value="{{ old('name') }}" 
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        id="password" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu:</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control" 
                        id="password_confirmation" 
                        required>
                </div>

                <button type="submit" class="btn btn-register w-100">Đăng ký</button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none" style="color: #6d6a4b;">Đã có tài khoản? Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
