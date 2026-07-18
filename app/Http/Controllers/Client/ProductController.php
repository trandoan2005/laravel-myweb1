<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        $title = "Tất cả sản phẩm";
        return view('client.product.index', compact('products', 'title'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // You can fetch related products if needed
        return view('client.product.show', compact('product'));
    }

    public function category($slug, $limit = 12)
    {
        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'categories.catename'
        )
        ->join('categories', 'products.cateid', 'categories.cateid')
        ->where('categories.slug', $slug)
        ->where('products.status', 1)
        ->paginate($limit);
        
        $title = "Danh mục: " . ($products->first() ? $products->first()->catename : '');
        return view('client.product.index', compact('products', 'title'));
    }

    public function brand($slug, $limit = 12)
    {
        $products = Product::select(
            'products.id',
            'products.productname',
            'products.slug',
            'products.price',
            'products.pricediscount',
            'products.image',
            'brands.brandname'
        )
        ->join('brands', 'products.brandid', 'brands.id')
        ->where('brands.slug', $slug)
        ->where('products.status', 1)
        ->paginate($limit);
        
        $title = "Thương hiệu: " . ($products->first() ? $products->first()->brandname : '');
        return view('client.product.index', compact('products', 'title'));
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $sort = $request->query('sort');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        $query = Product::where('status', 1);

        if ($q) {
            $query->where('productname', 'LIKE', "%{$q}%");
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'name_asc') {
            $query->orderBy('productname', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('productname', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $products = $query->paginate(12)->appends(request()->query());
        $title = "Kết quả tìm kiếm";
        if ($q) {
            $title .= " cho: " . $q;
        }

        return view('client.product.index', compact('products', 'title'));
    }
}
