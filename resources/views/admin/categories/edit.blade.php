@extends('admin.layouts.admin')

@section('title', 'Sửa Loại Sản Phẩm')

@section('content')
    <h2 class="mb-3">SỬA LOẠI SẢN PHẨM</h2>

    <form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên loại sản phẩm</label>
            <input type="text" name="catename" class="form-control"
                   value="{{ $category->catename }}" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control"
                   value="{{ $category->slug }}" required>
        </div>
        <div class="mb-3">
            <label>Ảnh danh mục</label><br>
            @if($category->image)
                <img src="{{ asset('uploads/categories/' . $category->image) }}"
                     alt="{{ $category->catename }}"
                     style="width: 100px; height: 100px; object-fit: cover;" class="mb-2">
                <p class="text-muted small">Chọn ảnh mới để thay thế ảnh hiện tại</p>
            @else
                <p class="text-muted small">Chưa có ảnh</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection