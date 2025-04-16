<header class="bg-light border-bottom">
    <!-- Phần trên: Logo + Ngày (trái) và Tìm kiếm + Đăng nhập/Đăng xuất (phải) -->
    <div class="container py-3">
        <div class="row align-items-center">
            <!-- Bên trái: Logo và Ngày -->
            <div class="col-md-6 d-flex align-items-center">
                <!-- Logo -->
                <a href="/" class="text-decoration-none">
                    <img src="{{ asset('logo/vnExpress.png') }}" alt="Logo vnExpress" style="height: 40px;">
                </a>
                <!-- Ngày -->
                <span class="ms-3 text-muted">
                    {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </span>
            </div>

            <!-- Bên phải: Tìm kiếm và Đăng nhập/Đăng xuất -->
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <!-- Form tìm kiếm -->
                <form class="d-flex me-3" method="GET" action="{{ route('home') }}">
                    <input class="form-control me-2" type="text" name="search" placeholder="Tìm kiếm..."
                        value="{{ request('search') }}" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>

                <!-- Đăng nhập/Đăng xuất -->
                @if (Auth::check())
                    <span class="me-2">Xin chào, {{ Auth::user()->name }}!</span>

                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning me-2">Quản trị</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0">Đăng xuất</button>
                    </form>
                @else
                    <a href="/register" class="btn btn-outline-success me-2">Đăng ký</a>
                    <a href="/login" class="btn btn-outline-primary">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Phần dưới: Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-top">
        <div class="container">
            <!-- Nút toggle cho thiết bị di động -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Các mục trong menu -->
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Trang chủ</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route('type') == $category->name ? 'active' : '' }}"
                                href="{{ route('category.show', ['type' => $category->name]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>
