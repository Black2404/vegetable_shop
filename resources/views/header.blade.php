<nav class="navbar navbar-expand-lg shadow-sm fixed-top" style="background-color: #f2efec;">
    <div class="container">
        <a class="navbar-brand" href="/">Rau Củ Quả</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="/products">Sản phẩm</a></li>

        @auth
        <!-- Nếu đã đăng nhập -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Thông tin cá nhân</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </li>
        @else
        <!-- Nếu chưa đăng nhập -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown">Tính năng</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
            </ul>
        </li>
        @endauth
                <li class="nav-item ms-3">
                    <a class="nav-link cart-icon" href="/cart">
                        <i class="bi bi-cart3"></i>
                        @php
                            use App\Models\Cart;

                            if (auth()->check()) {
                                $cart = Cart::where('user_id', auth()->id())->first();
                                $cartCount = $cart ? $cart->items()->sum('quantity') : 0;
                            } else {
                                $cartCount = 0;
                            }
                        @endphp

                        <span class="cart-badge">{{ $cartCount }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    body {
        font-family: 'Playfair Display', serif;
        background-color: #ffffff;
        padding-top: 80px;
    }
    .navbar-brand {
        font-size: 2rem;
        font-weight: 500;
        color: #4b4b32;
    }
    .nav-link {
        color: #3c3c28 !important;
        
    }
    .nav-link:hover {
        color: #7d7d52 !important;
    }
    .cart-icon {
        position: relative;
        font-size: 1.3rem;
        color: #000;
    }
    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        font-weight: bold;
    }
</style>
