<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->where('status', $status)
            ->orderBy('catename')
            ->paginate(10);

        return view('admin.categories.index', compact('list', 'status'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'catename'   => $request->catename,
            'slug'       => $request->slug,
            'image'      => $imageName,
            'status'     => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category  = Category::findOrFail($id);
        $imageName = $category->image;

        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('uploads/categories/' . $imageName))) {
                unlink(public_path('uploads/categories/' . $imageName));
            }

            $file      = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $imageName);
        }

        $category->update([
            'catename'   => $request->catename,
            'slug'       => $request->slug,
            'image'      => $imageName,
            'status'     => $request->status ?? 1,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}