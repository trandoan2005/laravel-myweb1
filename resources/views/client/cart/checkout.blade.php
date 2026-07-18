@extends('client.layouts.app')
@section('title', 'Thanh toán')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-gradient">Thanh toán đơn hàng</h2>
        <p class="text-muted">Vui lòng điền thông tin giao hàng bên dưới</p>
    </div>

    <div class="row g-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-5">
                    <h4 class="fw-bold mb-4 pb-3 border-bottom"><i class="bi bi-truck me-2 text-primary"></i> Thông tin giao hàng</h4>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">Họ tên người nhận <span class="text-danger">*</span></label>
                                <input type="text" name="fullname" class="form-control form-control-lg bg-light" value="{{ $customer->name ?? old('fullname') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-lg bg-light" value="{{ $customer->phone ?? '' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-secondary">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg bg-light" value="{{ $customer->email ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-secondary">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control form-control-lg bg-light" rows="3" required>{{ $customer->address ?? '' }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-gradient w-100 py-3 mt-5 rounded-pill shadow-sm fw-bold fs-5">Xác nhận đặt hàng ngay</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
                <div class="card-body p-5">
                    <h4 class="fw-bold mb-4 pb-3 border-bottom"><i class="bi bi-bag-check me-2 text-primary"></i> Đơn hàng của bạn</h4>
                    <ul class="list-group list-group-flush mb-3 bg-transparent">
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent py-3 border-bottom border-light">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-3">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/products/' . $item['image']) }}" alt="{{ $item['productname'] }}" class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 60px;" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $item['productname'] }}" class="rounded shadow-sm object-fit-cover" style="width: 60px; height: 60px;">
                                        @endif
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary border border-light">
                                            {{ $item['quantity'] }}
                                        </span>
                                    </div>
                                    <h6 class="my-0 fw-bold text-dark text-truncate" style="max-width: 150px;" title="{{ $item['productname'] }}">{{ $item['productname'] }}</h6>
                                </div>
                                <span class="text-dark fw-bold">{{ number_format($subtotal) }} đ</span>
                            </li>
                        @endforeach
                        
                        <li class="list-group-item d-flex justify-content-between px-0 py-4 bg-transparent mt-3 border-0">
                            <span class="fw-bold fs-5 text-secondary">Tổng cộng</span>
                            <strong class="text-danger fs-3 fw-bold">{{ number_format($total) }} đ</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
