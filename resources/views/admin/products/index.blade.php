@extends('admin.layouts.admin')

@section('title', 'Sản Phẩm')

@section('content')
    <h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Thêm mới</a>

        <div class="btn-group">
            <a href="{{ route('admin.products.index', ['status' => 1]) }}"
               class="btn btn-outline-success {{ $status === '1' ? 'active' : '' }}">
                Hiển thị
            </a>
            <a href="{{ route('admin.products.index', ['status' => 0]) }}"
               class="btn btn-outline-danger {{ $status === '0' ? 'active' : '' }}">
                Ẩn
            </a>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="width: 80px;">
                    <img src="{{ $item->image ?? 'https://via.placeholder.com/60x60?text=default' }}" 
                         alt="{{ $item->productname }}" 
                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                         onerror="this.src='https://via.placeholder.com/60x60?text=default'">
                </td>
                <td>{{ $item->productname }}</td>
                <td>{{ $item->catename }}</td>
                <td>{{ $item->brandname ?? 'N/A' }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
