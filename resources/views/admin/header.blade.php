<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="background-color: #f2efec;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Rau Củ Quả</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Người dùng</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.products') }}">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}">Đơn hàng</a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-link nav-link text-danger" style="display:inline;">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
        body {
            font-family: 'Playfair Display', serif;
            padding-top: 80px;
        }
        .navbar-brand {
            font-size: 2rem;
            font-weight: 500;
            color: #4b4b32;
        }
        .nav-link {
            color: #3c3c28 !important;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #7d7d52 !important;
        }
        .card-stat {
            background-color: #f2efec;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card-stat h4 {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #3c3c28;
        }
        .card-stat .value {
            font-size: 2rem;
            font-weight: bold;
            color: #4b4b32;
        }

    </style>