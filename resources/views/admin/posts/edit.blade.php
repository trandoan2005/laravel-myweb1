@extends('admin.layouts.admin')

@section('title', 'Sửa Bài Viết')

@section('content')
    <h2 class="mb-3">SỬA BÀI VIẾT</h2>

    <x-admin.alert />

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $post->slug) }}" required>
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Tác giả</label>
            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="">-- Chọn tác giả --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->fullname }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Trạng thái</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status1"
                       value="1" {{ old('status', $post->status) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="status1">Hiển thị</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status0"
                       value="0" {{ old('status', $post->status) == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="status0">Ẩn</label>
            </div>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control" rows="6">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Ảnh bài viết</label><br>
            @if($post->image)
                <img src="{{ asset('uploads/posts/' . $post->image) }}"
                     alt="{{ $post->title }}"
                     style="width: 100px; height: 100px; object-fit: cover;" class="mb-2">
                <p class="text-muted small">Chọn ảnh mới để thay thế ảnh hiện tại</p>
            @else
                <p class="text-muted small">Chưa có ảnh</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
