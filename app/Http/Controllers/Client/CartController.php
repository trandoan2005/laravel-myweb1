<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    public function show()
    {
        return view('client.cart.show');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::select(
            'id',
            'productname',
            'slug',
            'price',
            'pricediscount',
            'image'
        )->findOrFail($id);

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'productid' => $product->id,
                'productname' => $product->productname,
                'slug' => $product->slug,
                'image' => $product->image,
                'price' => $product->pricediscount ?: $product->price,
                'quantity' => 1,
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'status' => true,
            'message' => 'Đã thêm sản phẩm vào giỏ hàng.',
            'cartCount' => collect($cart)->sum('quantity'),
        ]);
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        
        if (empty($cart)) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        
        // Tổng tiền
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa sản phẩm.',
            'cartCount' => collect($cart)->sum('quantity'),
            'total' => $total,
            'isEmpty' => empty($cart),
        ]);
    }

    public function checkoutIndex()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $customer = \Illuminate\Support\Facades\Auth::guard('customer')->user();
        return view('client.cart.checkout', compact('cart', 'customer'));
    }

    public function checkout(Request $request)
    {
        // validate dữ liệu
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        // Lấy giỏ hàng từ Session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu giỏ hàng trống thì không cho đặt hàng
        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng đang trống.');
        }

        // Bắt đầu Transaction
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Kiểm tra xem số điện thoại đã tồn tại trong bảng customers chưa
            $customer = Customer::where('phone', $request->phone)->first();
            // Biến lưu id khách hàng
            $customerid = null;

            // Nếu chưa tìm thấy khách hàng
            if (empty($customer)) {
                // Thêm khách hàng mới vào Database
                $cus_afterinsert = Customer::create([
                    'name' => $request->fullname,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email
                ]);
                // Lấy id của khách hàng vừa tạo
                $customerid = $cus_afterinsert->id;
            } else {
                // Nếu khách hàng đã tồn tại thì sử dụng lại id của khách hàng đó
                $customerid = $customer->id;
            }

            // Tính total (tổng đơn hàng)
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            // Tạo đơn hàng
            $order = Order::create([
                'customer_id' => $customerid,
                'total_amount' => $total,
                'status' => 0,
                // 'note' => $request->note // Assuming we add this if needed
            ]);

            // Lưu từng sản phẩm vào bảng order_items
            // Khởi tạo mảng chứa danh sách sản phẩm
            $orderItems = [];
            foreach ($cart as $item) {
                // Thêm từng sản phẩm vào mảng
                $orderItems[] = [
                    'order_id' => $order->id, // Mã đơn hàng
                    'product_id' => $item['productid'], // Sản phẩm
                    'price' => $item['price'], // Giá tại thời điểm mua
                    'quantity' => $item['quantity'], // Số lượng mua
                    'product_name' => $item['productname'], // Bổ sung tên do schema của mình cần
                    // Thời gian tạo và cập nhật
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Lưu sản phẩm vào bảng order_items
            OrderItem::insert($orderItems);

            // Xác nhận Transaction
            // Ghi toàn bộ dữ liệu xuống Database
            \Illuminate\Support\Facades\DB::commit();

            // Xóa giỏ hàng sau khi đặt thành công
            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Đặt hàng thành công.');
        } catch (\Exception $e) {
            // Có lỗi => Hủy toàn bộ dữ liệu đã lưu
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
