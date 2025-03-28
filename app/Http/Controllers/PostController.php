<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index(Request $request)
    {
        $query = Post::query();

        // Tìm kiếm
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Lấy bài viết với phân trang (10 bài/trang)
        $posts = $query->with('category')->orderBy('created_at', 'DESC')->paginate(10);

        // Lấy bài viết nổi bật (bài có nhiều lượt xem nhất)
        $featuredPost = Post::with('category')->orderBy('views', 'DESC')->first();

        // Lấy tất cả danh mục (cho menu)
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories', 'featuredPost'));
    }

    public function getByType($type)
    {
       // Tìm danh mục theo slug
       $category = Category::where('name', $type)->firstOrFail();

       // Lấy bài viết thuộc danh mục này với phân trang
       $posts = Post::where('category_id', $category->id)
                    ->with('category')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);

       // Lấy bài viết nổi bật trong danh mục
       $featuredPost = Post::where('category_id', $category->id)
                           ->with('category')
                           ->orderBy('views', 'DESC')
                           ->first();

       // Lấy tất cả danh mục (cho menu)
       $categories = Category::all();

       return view('posts.index', compact('posts', 'categories', 'featuredPost', 'type'));
    }


    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        $post = Post::with('category')->findOrFail($id);

        // Tăng lượt xem
        $post->increment('views');

        return view('posts.show', compact('post'));
    }
}
