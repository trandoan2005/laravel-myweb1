@extends('admin.layouts.admin')

@section('title', 'Sửa Người Dùng')

@section('content')
    <h2 class="mb-3">SỬA NGƯỜI DÙNG</h2>

    <x-admin.alert />

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                   value="{{ old('fullname', $user->fullname) }}" required>
            @error('fullname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username', $user->username) }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password <span class="text-muted small">(để trống nếu không đổi)</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone', $user->phone) }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address', $user->address) }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="0" {{ old('gender', $user->gender) == '0' ? 'selected' : '' }}>Nam</option>
                <option value="1" {{ old('gender', $user->gender) == '1' ? 'selected' : '' }}>Nữ</option>
                <option value="2" {{ old('gender', $user->gender) == '2' ? 'selected' : '' }}>Khác</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control"
                   value="{{ old('birthday', $user->birthday) }}">
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : '' }}>Khóa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection