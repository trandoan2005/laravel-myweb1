@extends('client.layouts.app')
@section('title', 'Liên hệ - MyWeb Shop')

@section('content')
<div class="row mt-4 mb-5">
    <div class="col-md-5 mb-4">
        <div class="glass p-5 rounded-4 h-100 text-center">
            <h2 class="fw-bold text-gradient mb-4">Thông tin liên hệ</h2>
            <div class="text-start mt-5 fs-5">
                <p class="mb-4"><i class="bi bi-geo-alt-fill text-danger fs-3 me-3"></i> <strong>Địa chỉ:</strong> 123 Đường Công Nghệ, Quận 1, TP. HCM</p>
                <p class="mb-4"><i class="bi bi-telephone-fill text-primary fs-3 me-3"></i> <strong>Hotline:</strong> 1800 1234 5678</p>
                <p class="mb-4"><i class="bi bi-envelope-fill text-warning fs-3 me-3"></i> <strong>Email:</strong> support@mywebshop.com</p>
                <p class="mb-4"><i class="bi bi-clock-fill text-success fs-3 me-3"></i> <strong>Giờ làm việc:</strong> 8:00 AM - 10:00 PM</p>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-4">
        <div class="card-3d p-5 rounded-4 h-100 border-0">
            <h3 class="fw-bold mb-4">Gửi tin nhắn cho chúng tôi</h3>
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Họ và tên</label>
                    <input type="text" class="form-control-3d form-control py-3" placeholder="Nhập họ và tên..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control-3d form-control py-3" placeholder="Nhập địa chỉ email..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Nội dung</label>
                    <textarea class="form-control-3d form-control py-3" rows="5" placeholder="Nhập nội dung cần hỗ trợ..." required></textarea>
                </div>
                <button type="submit" class="btn-3d px-5 py-3 fs-5">Gửi lời nhắn <i class="bi bi-send ms-2"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
