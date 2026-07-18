@extends('admin.layouts.admin')

@section('title', 'Thêm Sản Phẩm')

@section('content')
    <h2 class="mb-3">THÊM SẢN PHẨM</h2>

    <x-admin.alert />

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="productname" class="form-control @error('productname') is-invalid @enderror"
                   value="{{ old('productname') }}" required>
            @error('productname')
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
            <label>Giá</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price') }}" required min="0">
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Giá khuyến mãi</label>
            <input type="number" name="price_sale" class="form-control @error('price_sale') is-invalid @enderror"
                   value="{{ old('price_sale', 0) }}" min="0">
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
                        {{ old('cateid') == $cat->cateid ? 'selected' : '' }}>
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
                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                       value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="status1">Hiển thị</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status0"
                       value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="status0">Ẩn</label>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Chi tiết sản phẩm</label>
            <textarea name="detail" class="form-control summernote" rows="5" placeholder="Nhập chi tiết sản phẩm">{{ old('detail') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Mô tả sản phẩm</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" class="form-control"
                   value="{{ old('quantity', 0) }}" min="0">
        </div>

        <div class="mb-3 img-group">
            <label class="form-label">Hình ảnh chính</label>
            <input type="file" name="img" class="form-control img-input">
            <div class="img-preview mt-2"></div>
            @error('img')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3 img-group">
            <label class="form-label">Hình ảnh phụ</label>
            <input type="file" name="imgs[]" class="form-control img-input" multiple>
            <div class="img-preview mt-2"></div>
            @error('imgs')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection