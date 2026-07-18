@extends('admin.layouts.admin')

@section('title', 'Thương Hiệu')

@section('content')
    <h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>

    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mã</th>
                <th>Hình ảnh</th>
                <th>Tên thương hiệu</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $index => $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/brands/' . $item->image) }}" width="80"
                             class="img-thumbnail">
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
        {{ $list->links() }}
    </div>
@endsection