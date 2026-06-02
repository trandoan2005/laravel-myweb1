<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.status',
                'users.fullname',
                'posts.created_at'
            )
            ->where('posts.status', $status)
            ->orderBy('posts.title')
            ->get();

        return view('admin.posts.index', compact('list', 'status'));
    }

    public function create()
    {
        $users = DB::table('users')->where('status', 1)->get();
        return view('admin.posts.create', compact('users'));
    }

    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => $request->user_id,
            'content' => $request->content ?? '',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.posts.index');
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
        DB::table('posts')->where('id', $id)->delete();
        return redirect()->route('admin.posts.index');
    }
}
