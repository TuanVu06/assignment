<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $posts = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->with('category')->paginate(10);

        $trashedPosts = Post::onlyTrashed()->with('category')->paginate(10, ['*'], 'trashed_page');

        $stats = [
            'total' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'views' => Post::sum('views'),
            'trashed' => Post::onlyTrashed()->count(),
        ];

        return view('admin.posts.index', compact('posts', 'trashedPosts', 'stats'));
    }

    public function create() {
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request) {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            // 'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('image', 'public');
        }
        $data['author_id'] = Auth::user()->id;

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài tin thành công!');
    }

    public function edit(Post $post) {
        $categories = Category::where('is_active', true)->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            // 'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('image', 'public');
        }
        // $data['author_id'] = auth()->id();

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài tin thành công!');
    }

    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài tin thành công!');
    }

    public function trashed(Request $request)
    {
        return $this->index($request);
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.index')->with('success', 'Khôi phục bài tin thành công!');
    }

    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();
        return redirect()->route('admin.posts.index')->with('success', 'Xóa vĩnh viễn bài tin thành công!');
    }   
}
