<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests\Admin\UserRequest;

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

    public function store(UserRequest $request)
    {
        try {
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

            return redirect()->route('admin.users.index')
                ->with('success', 'Thêm người dùng thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, string $id)
    {
        try {
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

            return redirect()->route('admin.users.index')
                ->with('success', 'Cập nhật người dùng thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}