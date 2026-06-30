@extends('admin.layouts.admin')

@section('title', 'Sửa Sản Phẩm')

@section('content')
    <h2 class="mb-3">SỬA SẢN PHẨM</h2>

    <x-admin.alert />

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control @error('productname') is-invalid @enderror"
                   value="{{ old('productname', $product->productname) }}" required>
            @error('productname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $product->slug) }}" required>
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price) }}" required min="0">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Giá khuyến mãi</label>
            <input type="number" name="price_sale" class="form-control @error('price_sale') is-invalid @enderror"
                   value="{{ old('price_sale', $product->price_sale ?? 0) }}" min="0">
            @error('price_sale')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Loại sản phẩm</label>
            <select name="cateid" class="form-control @error('cateid') is-invalid @enderror" required>
                <option value="">-- Chọn loại --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->cateid }}"
                        {{ old('cateid', $product->cateid) == $cat->cateid ? 'selected' : '' }}>
                        {{ $cat->catename }}
                    </option>
                @endforeach
            </select>
            @error('cateid')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Thương hiệu</label>
            <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                <option value="">-- Chọn thương hiệu --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                        {{ $brand->brandname }}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Trạng thái</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status1"
                       value="1" {{ old('status', $product->status) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="status1">Hiển thị</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status0"
                       value="0" {{ old('status', $product->status) == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="status0">Ẩn</label>
            </div>
        </div>

        <div class="mb-3">
            <label>Mô tả sản phẩm</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" class="form-control"
                   value="{{ old('quantity', $product->quantity) }}" min="0">
        </div>

        <div class="mb-3 img-group">
            <label class="form-label">Hình ảnh chính</label>
            <input type="file" name="img" class="form-control img-input">
            <div class="img-preview mt-2">
                @if ($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}"
                        class="img-thumbnail" width="120">
                @endif
            </div>
            @error('img')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 img-group">
            <label class="form-label">Hình ảnh phụ</label>
            <input type="file" name="imgs[]" class="form-control img-input" multiple>
            <div class="img-preview mt-2">
                @foreach ($product->images as $image)
                    <div class="d-inline-block position-relative sub-image-item" id="sub-img-container-{{ $image->id }}" style="margin-right: 10px; margin-bottom: 10px;">
                        <img src="{{ asset('storage/products/' . $image->image) }}"
                            class="img-thumbnail" width="100">
                        <button type="button"
                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 btn-delete-sub-img"
                                data-id="{{ $image->id }}"
                                data-url="{{ route('admin.products.delete-image', $image->id) }}"
                                style="padding: 2px 6px;"
                                title="Xóa ảnh này">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                @endforeach
            </div>
            @error('imgs')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection