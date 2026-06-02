<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = DB::table('brands')
            ->select('id', 'brandname', 'slug', 'image', 'status')
            ->where('status', $status)
            ->orderBy('brandname')
            ->get();

        return view('admin.brands.index', compact('list', 'status'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        DB::table('brands')->insert([
            'brandname' => $request->brandname,
            'slug' => $request->slug,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.brands.index');
    }

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        DB::table('brands')->where('id', $id)->delete();
        return redirect()->route('admin.brands.index');
    }
}