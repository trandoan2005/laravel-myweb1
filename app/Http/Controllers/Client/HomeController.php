<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Sản phẩm mới nhất
        $latestProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
            
        // Sản phẩm giảm giá
        $saleProducts = Product::where('status', 1)
            ->where('price_sale', '>', 0)
            ->take(8)
            ->get();

        return view('client.home.index', compact('latestProducts', 'saleProducts'));
    }
}
