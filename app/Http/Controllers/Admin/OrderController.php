<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('customer')->orderBy('created_at', 'desc');

        if ($request->has('q') && $request->q != '') {
            $q = $request->q;
            $query->whereHas('customer', function($q_cus) use ($q) {
                $q_cus->where('name', 'LIKE', "%{$q}%")
                      ->orWhere('phone', 'LIKE', "%{$q}%");
            })->orWhere('id', 'LIKE', "%{$q}%");
        }

        $orders = $query->paginate(10);
        
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 1)->sum('total_amount'); // assuming 1 is delivered/paid

        return view('admin.orders.index', compact('orders', 'totalOrders', 'totalRevenue'));
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
