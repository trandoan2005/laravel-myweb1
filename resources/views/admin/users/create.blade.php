@extends('admin.layouts.admin')

@section('title', 'Thêm Người Dùng')

@section('content')
    <h2 class="mb-3">THÊM NGƯỜI DÙNG</h2>

    <x-admin.alert />

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                   value="{{ old('fullname') }}" required>
            @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Nam</option>
                <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Nữ</option>
                <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>Khác</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control"
                   value="{{ old('birthday') }}">
        </div>

        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role" class="form-control">
                <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Khách hàng</option>
                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection