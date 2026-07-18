@extends('admin.layouts.admin')
@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Quản lý Đơn hàng</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Tổng số đơn hàng</h5>
                    <h3>{{ number_format($totalOrders) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu tạm tính (Đơn mới & đã giao)</h5>
                    <h3>{{ number_format($totalRevenue) }} đ</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 400px">
                    <input type="text" name="q" class="form-control" placeholder="Tìm tên KH, SĐT..." value="{{ request('q') }}">
                    <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
            </form>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã ĐH</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                            <td>{{ $order->customer->phone ?? 'N/A' }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-danger fw-bold">{{ number_format($order->total_amount) }} đ</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                @elseif ($order->status == 1)
                                    <span class="badge bg-success">Đã giao</span>
                                @elseif ($order->status == 2)
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info text-white">Chi tiết</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có đơn hàng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
