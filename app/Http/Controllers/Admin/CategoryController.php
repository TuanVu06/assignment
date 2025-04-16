<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->withCount('posts')->paginate(10);

        $stats = [
            'total' => Category::count(),
            'active' => Category::where('is_active', true)->count(),
        ];

        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Thêm loại tin thành công!');
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật loại tin thành công!');
    }

    public function destroy(Category $category)
    {
        // Kiểm tra xem loại tin có bài tin liên quan không (bao gồm cả bài tin xóa mềm)
        $postCount = Post::withTrashed()->where('category_id', $category->id)->count();

        if ($postCount > 0) {
            return redirect()->route('admin.categories.index')->with('error', "Không thể xóa loại tin này vì còn {$postCount} bài tin liên quan (kể cả bài tin đã xóa mềm). Vui lòng xóa vĩnh viễn tất cả bài tin trước!");
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa loại tin thành công!');
    }
}
