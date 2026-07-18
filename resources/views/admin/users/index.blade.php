@extends('admin.layouts.admin')

@section('title', 'Người Dùng')

@section('content')
    <h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

    <x-admin.alert />

    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">+ Thêm mới</a>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Username</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $index => $item)
            <tr>
                <td>{{ $list->firstItem() + $index }}</td>
                <td>{{ $item->fullname }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Kích hoạt</span>
                    @else
                        <span class="badge bg-danger">Khóa</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.users.edit', $item->id) }}"
                       class="btn btn-warning btn-sm mb-1">Sửa</a>

                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Xác nhận xóa người dùng này?')">Xóa</button>
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