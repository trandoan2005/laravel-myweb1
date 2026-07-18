<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng
     */
    public function index(Request $request)
    {
        $query = Customer::orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        $customers = $query->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Xóa khách hàng
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        
        // Kiểm tra xem khách hàng có đơn hàng nào không
        if ($customer->orders()->count() > 0) {
            return redirect()->route('admin.customers.index')->with('error', 'Không thể xóa khách hàng này vì đã có lịch sử mua hàng.');
        }

        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Xóa khách hàng thành công.');
    }
}
