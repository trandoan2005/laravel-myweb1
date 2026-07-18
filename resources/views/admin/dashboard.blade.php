@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Tổng quan Hệ thống</h3>
        <p class="text-muted mb-0">Theo dõi hoạt động và doanh thu hôm nay</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary bg-white shadow-sm fw-medium"><i class="bi bi-calendar-date me-2"></i> {{ date('d/m/Y') }}</button>
        <button class="btn btn-primary bg-gradient-primary border-0 shadow-sm fw-medium"><i class="bi bi-download me-2"></i> Xuất Báo cáo</button>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Doanh thu -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-card card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold mb-1 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Tổng doanh thu</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ number_format($totalRevenue) }} <span class="fs-6 text-muted fw-normal">đ</span></h3>
                </div>
                <div class="stat-icon-box bg-gradient-primary shadow-sm">
                    <i class="bi bi-wallet2"></i>
                </div>
            </div>
            <div class="mt-3 text-success fw-medium" style="font-size: 13px;">
                <i class="bi bi-arrow-up-right-circle me-1"></i> +15% so với tháng trước
            </div>
        </div>
    </div>
    
    <!-- Đơn hàng -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-card card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold mb-1 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Đơn hàng mới</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ $newOrdersCount }}</h3>
                </div>
                <div class="stat-icon-box bg-gradient-success shadow-sm">
                    <i class="bi bi-cart-check"></i>
                </div>
            </div>
            <div class="mt-3 text-success fw-medium" style="font-size: 13px;">
                <i class="bi bi-arrow-up-right-circle me-1"></i> +8% so với hôm qua
            </div>
        </div>
    </div>

    <!-- Khách hàng -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-card card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold mb-1 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Khách hàng</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ $customersCount }}</h3>
                </div>
                <div class="stat-icon-box bg-gradient-warning shadow-sm">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div class="mt-3 text-danger fw-medium" style="font-size: 13px;">
                <i class="bi bi-arrow-down-right-circle me-1"></i> -2% so với tháng trước
            </div>
        </div>
    </div>

    <!-- Sản phẩm -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-card card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted fw-bold mb-1 text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Sản phẩm</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ $productsCount }}</h3>
                </div>
                <div class="stat-icon-box bg-gradient-info shadow-sm">
                    <i class="bi bi-box-seam"></i>
                </div>
            </div>
            <div class="mt-3 text-muted fw-medium" style="font-size: 13px;">
                <i class="bi bi-dash-circle me-1"></i> Không thay đổi
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Sản phẩm mới nhất -->
    <div class="col-lg-6">
        <div class="admin-card card p-4 h-100">
            <h5 class="fw-bold mb-4">Sản phẩm mới nhất</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <tbody>
                        @forelse($recentProducts as $product)
                        <tr>
                            <td style="width: 50px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <h6 class="mb-0 fw-bold text-truncate" style="max-width: 200px;">{{ $product->productname }}</h6>
                                <small class="text-muted">{{ number_format($product->price) }}đ</small>
                            </td>
                            <td class="text-end">
                                <span class="badge bg-{{ $product->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $product->status == 1 ? 'Đang bán' : 'Tạm ẩn' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted">Chưa có sản phẩm nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100 mt-auto text-primary fw-bold">Xem tất cả sản phẩm</a>
        </div>
    </div>
    
    <!-- Đơn hàng gần đây -->
    <div class="col-lg-6">
        <div class="admin-card card p-4 h-100">
            <h5 class="fw-bold mb-4">Đơn hàng gần đây</h5>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td style="width: 50px;">
                                <div class="bg-light rounded-circle p-2 text-primary text-center"><i class="bi bi-bag-check fs-5"></i></div>
                            </td>
                            <td>
                                <h6 class="mb-0 fw-bold">#ORD-{{ $order->id }}</h6>
                                <small class="text-muted">{{ $order->customer->name ?? 'N/A' }} - {{ $order->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-end">
                                <span class="fw-bold text-success d-block">{{ number_format($order->total_amount) }}đ</span>
                                <span class="badge bg-{{ $order->status == 1 ? 'success' : 'warning' }}">
                                    {{ $order->status == 1 ? 'Đã giao' : 'Chờ xử lý' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted">Chưa có đơn hàng nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-light w-100 mt-auto text-primary fw-bold">Xem tất cả đơn hàng</a>
        </div>
    </div>
</div>
@endsection