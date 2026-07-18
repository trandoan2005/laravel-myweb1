<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($limit = 10)
    {
        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
            ->select(
                'id',
                'productname',
                'price',
                'image',
                'status',
                'cateid',
                'brand_id',
                'brand_id as brandid'
            )
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
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
            // Upload hình ảnh chính
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }
            // Lưu sản phẩm
            $product = Product::create([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'cateid' => $request->cateid,
                'brandid' => $request->brand_id ?? $request->brandid,
                'brand_id' => $request->brand_id ?? $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount ?? $request->price_sale ?? 0,
                'price_sale' => $request->price_sale ?? $request->pricediscount ?? 0,
                'description' => $request->description,
                'detail' => $request->detail,
                'status' => $request->status,
                'image' => $fileName,
            ]);
            // Upload hình ảnh phụ
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time(); // cùng timestamp
                foreach ($request->file('imgs') as $file) {
                    // 15_1751363000_1.jpg
                    $fileName = $product->id
                        . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $fileName, 'public');
                    // Lưu vào bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName,
                    ]);
                    $i++;
                }
            }
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();
        return view('admin.products.edit', 
            compact('product', 'categories', 'brands'));
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

            if ($request->hasFile('img')) {
                if ($imageName) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('products/' . $imageName);
                }

                $file      = $request->file('img');
                $imageName = \Illuminate\Support\Str::slug($request->productname) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('products', $imageName, 'public');
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
                'detail'      => $request->detail,
            ]);

            if ($request->hasFile('imgs')) {
                foreach ($request->file('imgs') as $index => $file) {
                    $subImageName = $product->id . '_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('products', $subImageName, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $subImageName,
                    ]);
                }
            }

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
        $product = Product::with('images')->findOrFail($id);

        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('products/' . $product->image);
        }

        foreach ($product->images as $subImage) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('products/' . $subImage->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function deleteImage($id)
    {
        try {
            $productImage = ProductImage::findOrFail($id);

            if ($productImage->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('products/' . $productImage->image);
            }

            $productImage->delete();

            return response()->json([
                'success' => true,
                'message' => 'Xóa ảnh phụ thành công!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
}