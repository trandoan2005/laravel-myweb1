@extends('client.layouts.app')
@section('title', 'Trang chủ - MyWebPro')

@section('content')
    <!-- Hero Section -->
    <div class="card-3d mb-5 text-white position-relative" style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.95), rgba(236, 72, 153, 0.95)); border-radius: 2rem;">
        <!-- Abstract glowing circles -->
        <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: rgba(255,255,255,0.1); top: -50px; right: -50px; filter: blur(20px);"></div>
        <div class="position-absolute rounded-circle" style="width: 200px; height: 200px; background: rgba(255,255,255,0.1); bottom: -30px; left: 10%; filter: blur(15px);"></div>
        
        <div class="text-center py-5 px-3 position-relative z-1" style="padding-top: 6rem !important; padding-bottom: 6rem !important;">
            <h1 class="hero-title display-4 fw-bolder mb-3" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.2);">Trải nghiệm công nghệ <span class="text-warning">Đỉnh Cao</span></h1>
            <p class="fs-5 mb-5 opacity-75 fw-medium">Sản phẩm chính hãng, dịch vụ chuyên nghiệp, giao diện đẳng cấp.</p>
            <a href="#new-products" class="btn-3d-secondary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg text-decoration-none">Khám phá ngay <i class="bi bi-arrow-down-circle ms-2"></i></a>
        </div>
    </div>

    <!-- Stats/Features 3D Cards -->
    <div class="row g-4 mb-5 pb-4">
        <div class="col-md-4">
            <div class="card-3d p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white mb-3 shadow" style="width: 60px; height: 60px;">
                    <i class="bi bi-shield-check fs-3"></i>
                </div>
                <h5 class="fw-bold">Chính hãng 100%</h5>
                <p class="text-muted small mb-0">Bảo hành uy tín, chất lượng đảm bảo tuyệt đối.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-3d p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white mb-3 shadow" style="width: 60px; height: 60px;">
                    <i class="bi bi-truck fs-3"></i>
                </div>
                <h5 class="fw-bold">Giao hàng hỏa tốc</h5>
                <p class="text-muted small mb-0">Nhận hàng trong 2h đối với khu vực nội thành.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-3d p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center text-white mb-3 shadow" style="width: 60px; height: 60px;">
                    <i class="bi bi-headset fs-3"></i>
                </div>
                <h5 class="fw-bold">Hỗ trợ 24/7</h5>
                <p class="text-muted small mb-0">Đội ngũ chuyên viên tư vấn luôn sẵn sàng.</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5 mt-5">
        <h2 id="new-products" class="fw-bold mb-0 text-gradient fs-2">Sản phẩm mới nhất</h2>
        <a href="{{ route('products.index') }}" class="btn-3d-secondary rounded-pill px-4 py-2 text-decoration-none fw-bold shadow-sm">Xem tất cả <i class="bi bi-arrow-right"></i></a>
    </div>
    
    <div class="row g-4">
        @foreach($latestProducts as $item)
            <x-product :item="$item" />
        @endforeach
    </div>

    @if($saleProducts->count() > 0)
        <div class="d-flex justify-content-between align-items-center mb-5 mt-5 pt-5 border-top border-light">
            <h2 class="fw-bold mb-0 text-gradient fs-2" style="background: linear-gradient(135deg, #ef4444, #f97316); -webkit-background-clip: text;">Khuyến mãi cực sốc</h2>
        </div>
        <div class="row g-4 mb-5">
            @foreach($saleProducts as $item)
                <x-product :item="$item" />
            @endforeach
        </div>
    @endif
@endsection
