<div class="sidebar">
    <div class="sidebar-header">
        <div class="bg-gradient-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-hexagon-fill text-white fs-4"></i>
        </div>
        <span>MyWeb<span class="text-primary">Pro</span></span>
    </div>
    
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="sidebar-item mt-3 mb-1 px-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; color: rgba(255,255,255,0.3);">
            Dữ liệu hệ thống
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-tags"></i>
                <span>Danh mục sản phẩm</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}" href="{{ route('admin.brands.index') }}">
                <i class="bi bi-award"></i>
                <span>Thương hiệu</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="bi bi-box-seam"></i>
                <span>Sản phẩm</span>
            </a>
        </li>

        <li class="sidebar-item mt-3 mb-1 px-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; color: rgba(255,255,255,0.3);">
            Bán hàng
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-cart3"></i>
                <span>Đơn hàng</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                <i class="bi bi-people"></i>
                <span>Khách hàng</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="bi bi-person-badge"></i>
                <span>Người dùng (Admin)</span>
            </a>
        </li>

        <li class="sidebar-item mt-3 mb-1 px-3 text-uppercase" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; color: rgba(255,255,255,0.3);">
            Nội dung
        </li>

        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Bài viết</span>
            </a>
        </li>
    </ul>
</div>