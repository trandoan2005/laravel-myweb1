@extends('admin.layouts.admin')

@section('title', 'Thương Hiệu')

@section('content')
    <h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

    <x-admin.alert />

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">+ Thêm mới</a>

        <div class="btn-group">
            <a href="{{ route('admin.brands.index', ['status' => 1]) }}"
               class="btn btn-outline-success {{ $status === '1' ? 'active' : '' }}">
                Hiển thị
            </a>
            <a href="{{ route('admin.brands.index', ['status' => 0]) }}"
               class="btn btn-outline-danger {{ $status === '0' ? 'active' : '' }}">
                Ẩn
            </a>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Logo</th>
                <th>Tên thương hiệu</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $index => $item)
            <tr>
                <td>{{ $list->firstItem() + $index }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('uploads/brands/' . $item->image) }}"
                             alt="{{ $item->brandname }}"
                             style="width: 60px; height: 60px; object-fit: cover;">
                    @else
                        <span class="text-muted">Chưa có</span>
                    @endif
                </td>
                <td>{{ $item->brandname }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.brands.edit', $item->id) }}"
                       class="btn btn-warning btn-sm mb-1">Sửa</a>

                    <form action="{{ route('admin.brands.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Xác nhận xóa thương hiệu này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $list->appends(['status' => $status])->links() }}
    </div>
@endsection