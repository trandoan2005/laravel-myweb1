<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        $orders = Order::where('customer_id', $customer->id)->orderBy('created_at', 'desc')->get();
        return view('client.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }

        $order = Order::with('orderItems')->where('customer_id', $customer->id)->where('id', $id)->firstOrFail();
        return view('client.orders.show', compact('order'));
    }
}
