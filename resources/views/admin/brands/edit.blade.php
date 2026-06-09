@extends('admin.layouts.admin')

@section('title', 'Sửa Thương Hiệu')

@section('content')
    <h2 class="mb-3">SỬA THƯƠNG HIỆU</h2>

    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control"
                   value="{{ $brand->brandname }}" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control"
                   value="{{ $brand->slug }}" required>
        </div>
        <div class="mb-3">
            <label>Logo thương hiệu</label><br>
            @if($brand->image)
                <img src="{{ asset('uploads/brands/' . $brand->image) }}"
                     alt="{{ $brand->brandname }}"
                     style="width: 100px; height: 100px; object-fit: cover;" class="mb-2">
                <p class="text-muted small">Chọn ảnh mới để thay thế logo hiện tại</p>
            @else
                <p class="text-muted small">Chưa có logo</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection