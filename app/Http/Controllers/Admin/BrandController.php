<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = Brand::select('id', 'brandname', 'slug', 'image', 'status')
            ->where('status', $status)
            ->orderBy('brandname')
            ->paginate(10);

        return view('admin.brands.index', compact('list', 'status'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/brands'), $imageName);
        }

        Brand::create([
            'brandname'  => $request->brandname,
            'slug'       => $request->slug,
            'image'      => $imageName,
            'status'     => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.brands.index');
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, string $id)
    {
        $brand     = Brand::findOrFail($id);
        $imageName = $brand->image;

        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/brands/' . $imageName))) {
                unlink(public_path('uploads/brands/' . $imageName));
            }

            $file      = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/brands'), $imageName);
        }

        $brand->update([
            'brandname'  => $request->brandname,
            'slug'       => $request->slug,
            'image'      => $imageName,
            'status'     => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.brands.index');
    }

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->image && file_exists(public_path('uploads/brands/' . $brand->image))) {
            unlink(public_path('uploads/brands/' . $brand->image));
        }

        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}