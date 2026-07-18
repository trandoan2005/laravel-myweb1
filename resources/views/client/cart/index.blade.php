@extends('client.layouts.app')
@section('title', 'Giỏ hàng')

@section('content')
<div class="card border-0 shadow-sm rounded-4 mb-5 mt-4">
    <div class="card-body p-5">
        <h2 class="mb-4 fw-bold text-gradient">Giỏ hàng của bạn</h2>

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-uppercase text-secondary small fw-bold">Sản phẩm</th>
                            <th scope="col" class="text-uppercase text-secondary small fw-bold">Đơn giá</th>
                            <th scope="col" class="text-uppercase text-secondary small fw-bold">Số lượng</th>
                            <th scope="col" class="text-uppercase text-secondary small fw-bold">Thành tiền</th>
                            <th scope="col" class="text-uppercase text-secondary small fw-bold text-end">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/products/' . $item['image']) }}" alt="{{ $item['proname'] }}" class="rounded shadow-sm me-3" style="width: 80px; height: 80px; object-fit: cover;" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="{{ $item['proname'] }}" class="rounded shadow-sm me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <a href="{{ route('products.show', \Illuminate\Support\Str::slug($item['proname'])) }}" class="text-dark text-decoration-none fw-bold fs-6">{{ $item['proname'] }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-medium text-dark">{{ number_format($item['price']) }} đ</td>
                                <td>
                                    <span class="badge bg-light text-dark border fs-6 px-3 py-2">{{ $item['quantity'] }}</span>
                                </td>
                                <td class="fw-bold text-danger">{{ number_format($subtotal) }} đ</td>
                                <td class="text-end">
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="row mt-4 pt-4 border-top">
                <div class="col-md-6 mb-4 mb-md-0 d-flex align-items-center">
                    <a href="{{ route('home') }}" class="text-decoration-none text-muted fw-medium hover-text-primary">
                        <i class="bi bi-arrow-left me-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex justify-content-md-end align-items-center mb-4">
                        <span class="text-muted fs-5 me-4">Tổng cộng:</span>
                        <span class="fw-bold text-danger fs-2">{{ number_format($total) }} đ</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary-gradient btn-lg px-5 py-3 rounded-pill shadow fw-bold w-100 w-md-auto">
                        Tiến hành thanh toán <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4 text-muted" style="font-size: 6rem; opacity: 0.5">
                    <i class="bi bi-cart-x"></i>
                </div>
                <p class="fs-4 text-dark fw-medium">Giỏ hàng của bạn đang trống!</p>
                <p class="text-muted mb-4">Có vẻ như bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
                <a href="{{ route('home') }}" class="btn btn-primary-gradient px-5 py-3 rounded-pill shadow-sm fw-bold">Mua sắm ngay</a>
            </div>
        @endif
    </div>
</div>
<style>
.hover-text-primary:hover { color: #4f46e5 !important; }
</style>
@endsection
