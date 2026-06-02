@extends('admin.layouts.admin')

@section('title', 'Thêm Người Dùng')

@section('content')
    <h2 class="mb-3">THÊM NGƯỜI DÙNG</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-control" required>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
                <option value="2">Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
