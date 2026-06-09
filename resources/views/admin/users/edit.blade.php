@extends('admin.layouts.admin')

@section('title', 'Sửa Người Dùng')

@section('content')
    <h2 class="mb-3">SỬA NGƯỜI DÙNG</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Họ tên</label>
            <input type="text" name="fullname" class="form-control"
                   value="{{ $user->fullname }}" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control"
                   value="{{ $user->username }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Password <span class="text-muted small">(để trống nếu không đổi)</span></label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control"
                   value="{{ $user->phone }}" required>
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control"
                   value="{{ $user->address }}">
        </div>
        <div class="mb-3">
            <label>Giới tính</label>
            <select name="gender" class="form-control" required>
                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>Nam</option>
                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nữ</option>
                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Khác</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" class="form-control"
                   value="{{ $user->birthday }}">
        </div>
        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Khóa</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection