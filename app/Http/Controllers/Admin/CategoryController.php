<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index($limit = 10)
    {
        // ==== ORM Eloquent
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'unique:categories,slug',
                    'regex:/^[a-z0-9-]+$/'
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => 'Trường :attribute phải là hình ảnh.',
                'img.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, webp.',
                'img.max' => 'Hình ảnh không được vượt quá :max KB.'
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái',
                'img' => 'Hình ảnh'
            ]
        );

        try {
            $imageName = null;

            if ($request->hasFile('img')) {
                $file      = $request->file('img');
                $imageName = \Illuminate\Support\Str::slug($request->catename) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('categories', $imageName, 'public');
            }

            Category::create([
                'catename'   => $request->catename,
                'slug'       => $request->slug,
                'image'      => $imageName,
                'status'     => $request->status ?? 1,
                'sort_order' => $request->sort_order ?? 0,
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Thêm loại sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'regex:/^[a-z0-9-]+$/',
                    Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
                ],
                'status' => 'required|in:0,1',
                'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.',
                'img.image' => 'Trường :attribute phải là hình ảnh.',
                'img.mimes' => 'Hình ảnh phải có định dạng: jpg, jpeg, png, webp.',
                'img.max' => 'Hình ảnh không được vượt quá :max KB.'
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái',
                'img' => 'Hình ảnh'
            ]
        );

        try {
            $category  = Category::findOrFail($id);
            $imageName = $category->image;

            if ($request->hasFile('img')) {
                if ($imageName) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('categories/' . $imageName);
                }

                $file      = $request->file('img');
                $imageName = \Illuminate\Support\Str::slug($request->catename) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('categories', $imageName, 'public');
            }

            $category->update([
                'catename'   => $request->catename,
                'slug'       => $request->slug,
                'image'      => $imageName,
                'status'     => $request->status ?? $category->status,
                'sort_order' => $request->sort_order ?? 0,
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('categories/' . $category->image);
        }

        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}