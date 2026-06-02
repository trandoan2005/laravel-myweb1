@extends('admin.layouts.admin')

@section('title', 'Thêm Thương Hiệu')

@section('content')
    <h2 class="mb-3">THÊM THƯƠNG HIỆU</h2>

    <form action="{{ route('admin.brands.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên thương hiệu</label>
            <input type="text" name="brandname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
