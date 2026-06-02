<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $list = DB::table('categories')
            ->select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->get();

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'catename' => $request->catename,
            'slug' => $request->slug,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        DB::table('categories')->where('cateid', $id)->delete();
        return redirect()->route('admin.categories.index');
    }
}