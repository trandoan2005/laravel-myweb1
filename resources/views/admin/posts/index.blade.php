@extends('admin.layouts.admin')

@section('title', 'Bài Viết')

@section('content')
    <h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $index => $item)
            <tr>
                {{-- Tính toán số thứ tự chính xác khi qua các trang khác nhau --}}
                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $index + 1 }}</td>
                <td>{{ $item->title }}</td>
                
                {{-- SỬA LỖI: Lấy fullname từ mối quan hệ user (with user) --}}
                <td>{{ $item->user->fullname ?? 'Không xác định' }}</td>
                
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.posts.edit', $item->id) }}"
                       class="btn btn-warning btn-sm mb-1">Sửa</a>

                    <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Không có bài viết nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- THÊM PHÂN TRANG: Hiển thị thanh chuyển trang và giữ lại bộ lọc status hiện tại --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $list->links() }}
    </div>
@endsection