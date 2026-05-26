<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return "Danh sách category";
    }

    public function create()
    {
        return "Form thêm category";
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return "Chi tiết category: " . $id;
    }

    public function edit($id)
    {
        return "Form sửa category: " . $id;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}