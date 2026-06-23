<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = Product::with([
                'category:cateid,catename',
                'brand:id,brandname'
            ])
            ->select('id', 'productname', 'price', 'image', 'status', 'cateid', 'brand_id')
            ->where('status', $status)
            ->orderBy('productname')
            ->paginate(10);

        return view('admin.products.index', compact('list', 'status'));
    }

    public function create()
    {
        $categories = Category::select('cateid', 'catename')
            ->where('status', 1)
            ->orderBy('catename')
            ->get();

        $brands = Brand::select('id', 'brandname')
            ->where('status', 1)
            ->orderBy('brandname')
            ->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $imageName = null;

            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $imageName);
            }

            Product::create([
                'productname' => $request->productname,
                'slug'        => $request->slug,
                'cateid'      => $request->cateid,
                'brand_id'    => $request->brand_id,
                'price'       => $request->price,
                'price_sale'  => $request->price_sale ?? $request->pricediscount ?? 0,
                'quantity'    => $request->quantity ?? 0,
                'image'       => $imageName,
                'status'      => $request->status ?? 1,
                'description' => $request->description ?? '',
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Sản phẩm không tồn tại');
        }

        $categories = Category::select('cateid', 'catename')
            ->where('status', 1)
            ->orderBy('catename')
            ->get();

        $brands = Brand::select('id', 'brandname')
            ->where('status', 1)
            ->orderBy('brandname')
            ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            $imageName = $product->image;

            if ($request->hasFile('image')) {
                if ($imageName && file_exists(public_path('uploads/products/' . $imageName))) {
                    unlink(public_path('uploads/products/' . $imageName));
                }

                $file      = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/products'), $imageName);
            }

            $product->update([
                'productname' => $request->productname,
                'slug'        => $request->slug,
                'cateid'      => $request->cateid,
                'brand_id'    => $request->brand_id,
                'price'       => $request->price,
                'price_sale'  => $request->price_sale ?? $request->pricediscount ?? 0,
                'quantity'    => $request->quantity ?? 0,
                'image'       => $imageName,
                'status'      => $request->status ?? $product->status,
                'description' => $request->description ?? '',
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();
        return redirect()->route('admin.products.index');
    }
}