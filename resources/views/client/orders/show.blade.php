@extends('client.layouts.app')
@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
<div class="row mt-4 mb-5">
    <div class="col-md-4 mb-4">
        <div class="card-3d border-0 p-4 h-100">
            <h4 class="fw-bold mb-4 border-bottom pb-3"><i class="bi bi-info-circle text-primary me-2"></i> Thông tin đơn hàng</h4>
            <p class="mb-2"><span class="text-muted">Mã đơn:</span> <strong class="fs-5">#{{ $order->id }}</strong></p>
            <p class="mb-2"><span class="text-muted">Ngày đặt:</span> <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong></p>
            <p class="mb-2"><span class="text-muted">Trạng thái:</span> 
                @if($order->status == 0)
                    <span class="badge bg-warning text-dark">Chờ xử lý</span>
                @elseif($order->status == 1)
                    <span class="badge bg-primary">Đang giao hàng</span>
                @else
                    <span class="badge bg-success">Hoàn thành</span>
                @endif
            </p>
            <hr>
            <h5 class="fw-bold mb-3">Thông tin người nhận</h5>
            <p class="mb-1"><strong>Họ tên:</strong> {{ $order->customer->name ?? 'N/A' }}</p>
            <p class="mb-1"><strong>SĐT:</strong> {{ $order->customer->phone ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->customer->address ?? 'N/A' }}</p>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="glass p-5 rounded-4 h-100">
            <h4 class="fw-bold mb-4 text-gradient"><i class="bi bi-cart-check me-2"></i> Danh sách sản phẩm</h4>
            
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="border-bottom border-dark">
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr class="border-bottom">
                                <td class="fw-bold py-3">{{ $item->product_name }}</td>
                                <td>{{ number_format($item->price) }} đ</td>
                                <td class="text-center"><span class="badge bg-secondary fs-6">{{ $item->quantity }}</span></td>
                                <td class="text-end fw-bold text-danger">{{ number_format($item->price * $item->quantity) }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold fs-5 pt-4">Tổng tiền đơn hàng:</td>
                            <td class="text-end fw-bold text-danger fs-3 pt-4">{{ number_format($order->total_amount) }} đ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="text-end mt-4">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary rounded-pill px-4"><i class="bi bi-arrow-left"></i> Quay lại danh sách</a>
            </div>
        </div>
    </div>
</div>
@endsection
