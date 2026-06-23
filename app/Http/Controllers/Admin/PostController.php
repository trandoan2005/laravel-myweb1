<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

use App\Http\Requests\Admin\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', '1');

        $list = Post::with(['user:id,fullname'])
            ->select('id', 'title', 'slug', 'status', 'user_id', 'image', 'created_at')
            ->where('status', $status)
            ->orderBy('title')
            ->paginate(10);

        return view('admin.posts.index', compact('list', 'status'));
    }

    public function create()
    {
        $users = User::select('id', 'fullname')
            ->where('status', 1)
            ->orderBy('fullname')
            ->get();

        return view('admin.posts.create', compact('users'));
    }

    public function store(PostRequest $request)
    {
        try {
            $imageName = null;

            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/posts'), $imageName);
            }

            Post::create([
                'title'   => $request->title,
                'slug'    => $request->slug,
                'user_id' => $request->user_id,
                'content' => $request->content ?? '',
                'image'   => $imageName,
                'status'  => $request->status ?? 1,
            ]);

            return redirect()->route('admin.posts.index')
                ->with('success', 'Thêm bài viết thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $post  = Post::findOrFail($id);
        $users = User::select('id', 'fullname')
            ->where('status', 1)
            ->orderBy('fullname')
            ->get();

        return view('admin.posts.edit', compact('post', 'users'));
    }

    public function update(PostRequest $request, string $id)
    {
        try {
            $post      = Post::findOrFail($id);
            $imageName = $post->image;

            if ($request->hasFile('image')) {
                if ($imageName && file_exists(public_path('uploads/posts/' . $imageName))) {
                    unlink(public_path('uploads/posts/' . $imageName));
                }

                $file      = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/posts'), $imageName);
            }

            $post->update([
                'title'   => $request->title,
                'slug'    => $request->slug,
                'user_id' => $request->user_id,
                'content' => $request->content ?? '',
                'image'   => $imageName,
                'status'  => $request->status ?? $post->status,
            ]);

            return redirect()->route('admin.posts.index')
                ->with('success', 'Cập nhật bài viết thành công');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
            unlink(public_path('uploads/posts/' . $post->image));
        }

        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}