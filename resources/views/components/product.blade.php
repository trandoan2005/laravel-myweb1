@props(['item'])

<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="card-3d h-100 p-2">
        <a href="{{ route('products.show', $item->slug) }}" class="d-block img-wrapper">
            @if($item->image)
                <img src="{{ asset('storage/products/' . $item->image) }}" class="img-fluid w-100 object-fit-cover" alt="{{ $item->productname }}" style="height: 250px;" onerror="this.src='{{ asset('images/no-image.png') }}'">
            @else
                <img src="{{ asset('images/no-image.png') }}" class="img-fluid w-100 object-fit-cover" alt="{{ $item->productname }}" style="height: 250px;">
            @endif
            @if($item->price_sale > 0 && $item->price_sale < $item->price)
                <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 shadow-lg" style="border-radius: 12px; padding: 8px 15px;">
                    Sale {{ round((($item->price - $item->price_sale) / $item->price) * 100) }}%
                </span>
            @endif
        </a>
        <div class="card-body d-flex flex-column p-4 bg-white mt-2" style="border-radius: 1.2rem;">
            <h5 class="fs-6 mb-2 fw-bold text-truncate" title="{{ $item->productname }}">
                <a href="{{ route('products.show', $item->slug) }}" class="text-decoration-none text-dark hover-text-primary">{{ $item->productname }}</a>
            </h5>
            <div class="mt-auto mb-4">
                @if($item->price_sale > 0 && $item->price_sale < $item->price)
                    <div class="text-danger fw-bold fs-5">{{ number_format($item->price_sale) }} đ</div>
                    <div class="text-muted text-decoration-line-through small">{{ number_format($item->price) }} đ</div>
                @else
                    <div class="text-primary fw-bold fs-5">{{ number_format($item->price) }} đ</div>
                    <div class="text-muted small invisible">placeholder</div>
                @endif
            </div>
            
            <form action="{{ route('cart.add', $item->id) }}" method="POST" class="mt-auto w-100 form-add-cart">
                @csrf
                <input type="hidden" name="product_id" value="{{ $item->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-3d w-100 shadow-sm">
                    <i class="bi bi-cart-plus fs-5 me-2"></i> Thêm vào giỏ
                </button>
            </form>
        </div>
    </div>
</div>
