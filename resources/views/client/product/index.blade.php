@extends('client.layouts.app')
@section('title', $title ?? 'Sản phẩm')

@section('content')
    <div class="glass p-4 rounded-4 mb-4 mt-3">
        <h2 class="mb-0 fw-bold text-gradient">{{ $title ?? 'Sản phẩm' }}</h2>
    </div>
    
    @if($products->count() > 0)
        <div class="row">
            @foreach($products as $item)
                <x-product :item="$item" />
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-warning glass border-0 text-center py-5">
            <i class="bi bi-search fs-1 d-block mb-3"></i>
            <h4>Không tìm thấy sản phẩm nào!</h4>
        </div>
    @endif
@endsection
