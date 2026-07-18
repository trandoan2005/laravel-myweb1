@extends('client.layouts.app')
@section('title', 'Đăng nhập - MyWeb Shop')

@section('content')
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-5">
        <div class="card-3d border-0 p-5 rounded-4">
            <h2 class="text-center fw-bold text-gradient mb-4">Đăng nhập</h2>
            
            @if($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.login.post') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control-3d form-control py-3" placeholder="Nhập email của bạn..." required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control-3d form-control py-3" placeholder="Nhập mật khẩu..." required>
                </div>
                <button type="submit" class="btn-3d w-100 py-3 mt-2 fs-5">Đăng nhập</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-muted">Chưa có tài khoản? <a href="{{ route('customer.register') }}" class="text-primary fw-bold text-decoration-none">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
