@extends('client.layouts.app')
@section('title', 'Đơn hàng của tôi - MyWeb Shop')

@section('content')
<div class="glass p-5 rounded-4 mt-4 mb-5">
    <h2 class="fw-bold text-gradient mb-4">Lịch sử mua hàng</h2>
    
    @if($orders->count() > 0)
        <div class="table-responsive mt-4">
            <table class="table table-hover align-middle bg-white rounded-3 shadow-sm overflow-hidden">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Mã đơn hàng</th>
                        <th class="py-3">Ngày đặt</th>
                        <th class="py-3">Tổng tiền</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="py-3 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="fw-bold text-primary">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold text-danger">{{ number_format($order->total_amount) }} đ</td>
                            <td>
                                @if($order->status == 0)
                                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                @elseif($order->status == 1)
                                    <span class="badge bg-primary">Đang giao hàng</span>
                                @else
                                    <span class="badge bg-success">Hoàn thành</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">Chi tiết <i class="bi bi-eye ms-1"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x text-muted" style="font-size: 5rem;"></i>
            <p class="fs-4 mt-3 text-muted">Bạn chưa có đơn hàng nào!</p>
            <a href="{{ route('products.index') }}" class="btn-3d mt-4 px-5">Mua sắm ngay</a>
        </div>
    @endif
</div>
@endsection
