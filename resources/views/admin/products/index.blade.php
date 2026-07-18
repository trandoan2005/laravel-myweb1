@extends('admin.layouts.admin')

@section('title', 'Sản Phẩm')

@section('content')
    <h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th width="120">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $item)
            <tr>
                <td>{{ $list->firstItem() + $loop->index }}</td>
                <td>{{ $item->productname }}</td>
                <td>{{ $item->category?->catename }}</td>
                <td>{{ $item->brand?->brandname }}</td>
                <td>{{ number_format($item->price) }} đ</td>
                <td>@if($item->status)
                    <span class="badge bg-success">Hiện</span>
                    @else
                    <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="{{ route('admin.products.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">
                    Không có dữ liệu
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>
@endsection