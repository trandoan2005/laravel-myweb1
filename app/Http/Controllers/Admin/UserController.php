<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = User::select('id', 'fullname', 'username', 'email', 'status')
            ->where('status', $status)
            ->orderBy('fullname')
            ->paginate(10);

        return view('admin.users.index', compact('list', 'status'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'birthday' => $request->birthday,
            'role'     => $request->role ?? 0,
            'status'   => 1,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = [
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'birthday' => $request->birthday,
            'status'   => $request->status ?? $user->status,
        ];

        // Chỉ đổi password nếu có nhập
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}