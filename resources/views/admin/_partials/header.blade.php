<nav class="admin-topbar">
    <div class="d-flex align-items-center">
        <!-- Optional search or breadcrumbs can go here -->
        <h5 class="m-0 text-muted d-none d-md-block">Quản trị Hệ thống</h5>
    </div>
    
    <div class="d-flex align-items-center gap-4">
        <!-- Notifications -->
        <div class="position-relative cursor-pointer text-muted">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
            </span>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown">
            <div class="d-flex align-items-center gap-2 cursor-pointer" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 36px; height: 36px; font-size: 14px;">
                    {{ strtoupper(substr(Auth::user()->fullname ?? 'A', 0, 1)) }}
                </div>
                <div class="d-none d-md-block">
                    <div class="fw-bold text-dark lh-1" style="font-size: 14px;">{{ Auth::user()->fullname ?? 'Admin' }}</div>
                    <div class="text-muted small lh-1 mt-1" style="font-size: 12px;">Administrator</div>
                </div>
                <i class="bi bi-chevron-down text-muted ms-1" style="font-size: 12px;"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2 text-muted"></i> Hồ sơ</a></li>
                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2 text-muted"></i> Cài đặt</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-bold">
                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>