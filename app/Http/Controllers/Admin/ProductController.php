<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.id',
                'products.productname',
                'products.price',
                'products.image',
                'products.status',
                'categories.catename',
                'brands.brandname'
            )
            ->where('products.status', $status)
            ->orderBy('products.productname')
            ->get();

        return view('admin.products.index', compact('list', 'status'));
    }

    public function create()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        $brands = DB::table('brands')->where('status', 1)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        DB::table('products')->insert([
            'productname' => $request->productname,
            'slug' => $request->slug,
            'cateid' => $request->cateid,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('admin.products.index');
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }

    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}