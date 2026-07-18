@extends('client.layouts.app')
@section('title', 'Về chúng tôi - MyWeb Shop')

@section('content')
<div class="glass p-5 rounded-4 mt-4 mb-5 text-center">
    <h1 class="fw-bold text-gradient mb-4">Về chúng tôi</h1>
    <p class="fs-4 mb-5 text-muted">Chào mừng bạn đến với <span class="fw-bold text-dark">MyWeb Shop</span> - Trải nghiệm mua sắm công nghệ đỉnh cao!</p>
    
    <div class="row text-start mt-5">
        <div class="col-md-6 mb-4">
            <div class="card-3d p-4 h-100">
                <h3 class="fw-bold mb-3"><i class="bi bi-rocket-takeoff text-primary me-2"></i> Tầm nhìn</h3>
                <p class="text-muted fs-5">Chúng tôi định hướng trở thành nhà phân phối các sản phẩm công nghệ hàng đầu, mang lại cho người dùng trải nghiệm mua sắm trực tuyến chân thực và tiện lợi nhất bằng công nghệ 3D Premium.</p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card-3d p-4 h-100">
                <h3 class="fw-bold mb-3"><i class="bi bi-shield-check text-success me-2"></i> Sứ mệnh</h3>
                <p class="text-muted fs-5">Cung cấp những thiết bị chính hãng, chất lượng với mức giá tốt nhất thị trường, đi kèm dịch vụ chăm sóc khách hàng tận tâm và chuyên nghiệp 24/7.</p>
            </div>
        </div>
    </div>
</div>
@endsection
