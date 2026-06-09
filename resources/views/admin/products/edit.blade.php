@extends('admin.layouts.admin')

@section('title', 'Sửa Sản Phẩm')

@section('content')
    <h2 class="mb-3">SỬA SẢN PHẨM</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control"
                   value="{{ $product->productname }}" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control"
                   value="{{ $product->slug }}" required>
        </div>
        <div class="mb-3">
            <label>Loại sản phẩm</label>
            <select name="cateid" class="form-control" required>
                <option value="">-- Chọn loại --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->cateid }}"
                        {{ $product->cateid == $cat->cateid ? 'selected' : '' }}>
                        {{ $cat->catename }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Thương hiệu</label>
            <select name="brand_id" class="form-control">
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->brandname }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control"
                   value="{{ $product->price }}" required min="0" step="0.01">
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" class="form-control"
                   value="{{ $product->quantity }}" min="0">
        </div>
        <div class="mb-3">
            <label>Ảnh sản phẩm</label><br>
            @if($product->image)
                <img src="{{ asset('uploads/products/' . $product->image) }}"
                     alt="{{ $product->productname }}"
                     style="width: 100px; height: 100px; object-fit: cover;" class="mb-2">
                <p class="text-muted small">Chọn ảnh mới để thay thế ảnh hiện tại</p>
            @else
                <p class="text-muted small">Chưa có ảnh</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection