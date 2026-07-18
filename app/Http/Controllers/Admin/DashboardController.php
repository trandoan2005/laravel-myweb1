<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate statistics
        $totalRevenue = Order::where('status', 1)->sum('total_amount'); // 1 = Đã giao
        $newOrdersCount = Order::where('status', 0)->count(); // 0 = Chờ xử lý
        $customersCount = Customer::count();
        $productsCount = Product::count();
        
        // Get 5 recent orders
        $recentOrders = Order::with('customer')->orderBy('created_at', 'desc')->take(5)->get();
        
        // Get 5 newest products
        $recentProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 
            'newOrdersCount', 
            'customersCount', 
            'productsCount', 
            'recentOrders',
            'recentProducts'
        ));
    }
}
