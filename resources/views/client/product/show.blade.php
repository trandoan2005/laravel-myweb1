@extends('client.layouts.app')
@section('title', $product->productname)

@section('content')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category->slug ?? '') }}">{{ $product->category->catename ?? 'Danh mục' }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $product->productname }}</li>
      </ol>
    </nav>

    <div class="row mt-4">
        <div class="col-md-5">
            <div class="card-3d p-2">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid rounded-4 w-100 shadow-sm" alt="{{ $product->productname }}" onerror="this.src='{{ asset('images/no-image.png') }}'">
                @else
                    <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded-4 w-100 shadow-sm" alt="{{ $product->productname }}">
                @endif
            </div>
        </div>
        <div class="col-md-7">
            <div class="glass p-5 rounded-4 h-100">
                <h1 class="fw-bold text-gradient mb-3">{{ $product->productname }}</h1>
                <p class="text-muted">Mã SP: <span class="badge bg-secondary">#{{ $product->id }}</span> | Thương hiệu: <a href="{{ route('products.brand', $product->brand->slug ?? '') }}" class="text-primary fw-bold text-decoration-none">{{ $product->brand->brandname ?? 'Đang cập nhật' }}</a></p>
                
                <div class="my-4 p-4 bg-light rounded-4 shadow-sm" style="border-left: 5px solid #4f46e5;">
                    @if($product->price_sale > 0 && $product->price_sale < $product->price)
                        <span class="fs-1 text-danger fw-bold">{{ number_format($product->price_sale) }} đ</span>
                        <span class="fs-4 text-muted text-decoration-line-through ms-3">{{ number_format($product->price) }} đ</span>
                        <span class="badge bg-danger ms-3 rounded-pill">Giảm {{ round((($product->price - $product->price_sale) / $product->price) * 100) }}%</span>
                    @else
                        <span class="fs-1 text-danger fw-bold">{{ number_format($product->price) }} đ</span>
                    @endif
                </div>

                <p class="fs-5 mb-5 lh-base text-secondary">{{ $product->description }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4 form-add-cart">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row align-items-center g-3 mb-4">
                        <div class="col-auto">
                            <label for="quantity" class="fw-bold fs-5 mb-0">Số lượng:</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->quantity > 0 ? $product->quantity : 1 }}" class="form-control form-control-lg text-center fw-bold shadow-sm" style="width: 100px;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary-gradient btn-lg px-5 py-3 w-100 rounded-pill shadow-sm fw-bold">
                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ hàng ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="glass p-5 rounded-4 mt-5 mb-5">
        <h3 class="fw-bold text-gradient mb-4">Chi tiết sản phẩm</h3>
        <div class="product-content lh-lg">
            {!! $product->detail !!}
        </div>
    </div>
@endsection
