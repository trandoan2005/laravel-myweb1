@extends('admin.layouts.admin')
@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Đơn hàng #{{ $order->id }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Thông tin khách hàng -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <strong>Thông tin Khách hàng</strong>
                </div>
                <div class="card-body">
                    <p><strong>Họ tên:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
                    <p><strong>SĐT:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Trạng thái đơn hàng -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light">
                    <strong>Cập nhật trạng thái</strong>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <p><strong>Trạng thái hiện tại:</strong> 
                        @if ($order->status == 0)
                            <span class="badge bg-warning text-dark">Chờ xử lý</span>
                        @elseif ($order->status == 1)
                            <span class="badge bg-success">Đã giao</span>
                        @elseif ($order->status == 2)
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </p>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex mt-2">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select me-2" style="max-width: 200px">
                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã giao</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <strong>Danh sách Sản phẩm</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/products/' . $item->product->image) }}" width="60" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" width="60" class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format($item->price) }} đ</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-danger fw-bold">{{ number_format($item->price * $item->quantity) }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Tổng cộng:</th>
                        <th class="text-danger fs-5">{{ number_format($order->total_amount) }} đ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
