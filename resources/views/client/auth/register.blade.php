@extends('client.layouts.app')
@section('title', 'Đăng ký - MyWeb Shop')

@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-6">
        <div class="card-3d border-0 p-5 rounded-4">
            <h2 class="text-center fw-bold text-gradient mb-4">Đăng ký tài khoản</h2>
            
            @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.register.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Họ và tên</label>
                    <input type="text" name="name" class="form-control-3d form-control py-3" placeholder="Nhập họ và tên..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control-3d form-control py-3" placeholder="Nhập số điện thoại..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control-3d form-control py-3" placeholder="Nhập email..." required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" name="password" class="form-control-3d form-control py-3" placeholder="Mật khẩu..." required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control-3d form-control py-3" placeholder="Nhập lại mật khẩu..." required>
                    </div>
                </div>
                <button type="submit" class="btn-3d w-100 py-3 mt-2 fs-5">Tạo tài khoản</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-muted">Đã có tài khoản? <a href="{{ route('customer.login') }}" class="text-primary fw-bold text-decoration-none">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
