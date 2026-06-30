@extends('admin.layouts.admin')

@section('title', 'Thêm Thương Hiệu')

@section('content')
    <h2 class="mb-3">THÊM THƯƠNG HIỆU</h2>

    <x-admin.alert />

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control @error('brandname') is-invalid @enderror"
                   value="{{ old('brandname') }}" required>
            @error('brandname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug') }}" required>
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Trạng thái</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status1"
                       value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="status1">Hiển thị</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status0"
                       value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="status0">Ẩn</label>
            </div>
        </div>

        <div class="mb-3 img-group">
            <label class="form-label">Hình ảnh</label>
            <input type="file" name="img" class="form-control img-input">
            <div class="img-preview mt-2"></div>
            @error('img')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection