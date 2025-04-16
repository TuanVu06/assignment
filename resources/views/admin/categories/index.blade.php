<!-- resources/views/admin/categories/index.blade.php -->
@extends('admin.layout.app')

@section('content')
    <h1 class="mb-4">Quản trị loại tin</h1>

    <!-- Thống kê -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Tổng số loại tin</h5>
                    <p class="card-text fs-4">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Loại tin hoạt động</h5>
                    <p class="card-text fs-4">{{ $stats['active'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tìm kiếm và thêm mới -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm loại tin..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm</button>
        </form>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm loại tin</a>
    </div>

    <!-- Bảng danh sách -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Số bài tin</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? 'N/A' }}</td>
                    <td>{{ $category->posts_count }}</td>
                    <td>{{ $category->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Phân trang -->
    {{ $categories->links() }}
@endsection