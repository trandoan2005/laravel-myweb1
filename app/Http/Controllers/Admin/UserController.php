<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = DB::table('users')
            ->select('id', 'fullname', 'username', 'email', 'status')
            ->where('status', $status)
            ->orderBy('fullname')
            ->get();

        return view('admin.users.index', compact('list', 'status'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'role' => $request->role ?? 0,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.users.index');
    }

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.users.index');
    }
}