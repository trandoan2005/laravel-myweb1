@extends('admin.layouts.admin')

@section('title', 'Thêm Bài Viết')

@section('content')
    <h2 class="mb-3">THÊM BÀI VIẾT</h2>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tác giả</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Chọn tác giả --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control" rows="6"></textarea>
        </div>
        <div class="mb-3">
            <label>Ảnh bài viết</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection