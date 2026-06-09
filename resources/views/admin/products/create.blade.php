@extends('admin.layouts.admin')

@section('title', 'Thêm Sản Phẩm')

@section('content')
    <h2 class="mb-3">THÊM SẢN PHẨM</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Loại sản phẩm</label>
            <select name="cateid" class="form-control" required>
                <option value="">-- Chọn loại --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->cateid }}">{{ $cat->catename }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Thương hiệu</label>
            <select name="brand_id" class="form-control">
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->brandname }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" required min="0" step="0.01">
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" class="form-control" value="0" min="0">
        </div>
        <div class="mb-3">
            <label>Ảnh sản phẩm</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection