<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

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
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
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
            'quantity'    => $request->quantity ?? 0,
            'image'       => $imageName,
            'status'      => 1,
        ]);

        return redirect()->route('admin.products.index');
    }

    public function edit(string $id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, string $id)
    {
        $product   = Product::findOrFail($id);
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
            'quantity'    => $request->quantity ?? 0,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.products.index');
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