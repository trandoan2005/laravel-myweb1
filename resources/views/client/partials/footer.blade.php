<footer class="footer-3d pt-5 pb-4 mt-5">
    <div class="container relative" style="z-index: 10;">
        <div class="row gy-4">
            <!-- Cột 1 -->
            <div class="col-lg-4 col-md-6 pe-lg-5">
                <a href="{{ route('home') }}" class="d-inline-flex align-items-center text-white text-decoration-none mb-4">
                    <div class="bg-gradient-primary rounded-circle d-flex align-items-center justify-content-center me-2 shadow" style="width: 40px; height: 40px;">
                        <i class="bi bi-hexagon-fill fs-5"></i>
                    </div>
                    <span class="fs-3 fw-bolder tracking-tight">MyWeb<span class="text-primary">Pro</span></span>
                </a>
                <p class="text-muted lh-lg mb-4">
                    Mang đến trải nghiệm mua sắm công nghệ tuyệt đỉnh với giao diện 3D chuyên nghiệp. Sản phẩm chất lượng, dịch vụ tận tâm.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>

            <!-- Cột 2 -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Khám phá</h5>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                    <li><a href="#">Thương hiệu nổi bật</a></li>
                    <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                </ul>
            </div>

            <!-- Cột 3 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Hỗ trợ khách hàng</h5>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ hỗ trợ</a></li>
                </ul>
            </div>

            <!-- Cột 4 -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Đăng ký nhận tin</h5>
                <p class="text-muted mb-3">Nhận thông tin ưu đãi mới nhất từ MyWebPro.</p>
                <div class="position-relative">
                    <input type="email" class="form-control rounded-pill border-0 ps-4 pe-5 py-3 shadow-sm bg-light" placeholder="Nhập email của bạn...">
                    <button class="btn btn-primary rounded-circle position-absolute top-50 translate-middle-y end-0 me-1 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row mt-5 pt-4 border-top border-secondary opacity-50">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0 small text-muted">&copy; {{ date('Y') }} MyWebPro Shop. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="mb-0 small text-muted">Thiết kế với <i class="bi bi-heart-fill text-danger mx-1"></i> bởi Trần Văn Đoàn</p>
            </div>
        </div>
    </div>
</footer>
