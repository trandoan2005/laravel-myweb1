<nav class="navbar navbar-expand-lg navbar-light glass-panel floating-navbar mt-3 mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold text-gradient fs-4" href="{{ route('home') }}"><i class="bi bi-hexagon-fill me-2"></i>MyWebPro</a>
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-medium gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Sản phẩm</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.category') ? 'active' : '' }}" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                        Danh mục
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg" style="border-radius: 15px;">
                        @foreach($categories as $cat)
                            <li><a class="dropdown-item py-2" href="{{ route('products.category', $cat->slug) }}">{{ $cat->catename }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('products.brand') ? 'active' : '' }}" href="#" id="brandDropdown" role="button" data-bs-toggle="dropdown">
                        Thương hiệu
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg" style="border-radius: 15px;">
                        @foreach($brands as $brand)
                            <li><a class="dropdown-item py-2" href="{{ route('products.brand', $brand->slug) }}">{{ $brand->brandname }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Về chúng tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Liên hệ</a>
                </li>
            </ul>

            <form class="d-flex me-4 my-2 my-lg-0" action="{{ route('products.search') }}" method="GET">
                <div class="search-box-3d">
                    <input type="search" name="q" placeholder="Tìm kiếm sản phẩm..." value="{{ request('q') }}">
                    <button class="btn btn-link text-primary p-0 ms-2" type="submit"><i class="bi bi-search fs-5"></i></button>
                </div>
            </form>

            <ul class="navbar-nav align-items-center">
                @if(Auth::guard('customer')->check())
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle fw-bold text-primary d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                            <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px;">
                                {{ strtoupper(substr(Auth::guard('customer')->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ explode(' ', Auth::guard('customer')->user()->name)[0] }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 15px;">
                            <li><a class="dropdown-item py-2" href="{{ route('orders.index') }}"><i class="bi bi-box-seam me-2"></i>Đơn hàng của tôi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a class="btn btn-3d-secondary rounded-pill px-4 fw-bold" href="{{ route('customer.login') }}">Đăng nhập</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link position-relative btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" href="{{ route('cart.index') }}" style="width: 45px; height: 45px;">
                        <i class="bi bi-cart3 fs-5 text-primary"></i>
                        @php $cartQty = count(session('cart', [])); @endphp
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm border border-2 border-white {{ $cartQty == 0 ? 'd-none' : '' }}">
                            {{ $cartQty }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
