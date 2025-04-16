@extends('admin.layout.app')

@section('content')
    <h1 class="mb-4">Quản trị tin</h1>

    <!-- Thống kê -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Tổng số bài tin</h5>
                    <p class="card-text fs-4">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Bài tin xuất bản</h5>
                    <p class="card-text fs-4">{{ $stats['published'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Lượt xem</h5>
                    <p class="card-text fs-4">{{ $stats['views'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Bài tin đã xóa</h5>
                    <p class="card-text fs-4">{{ $stats['trashed'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.posts.index') && !request()->has('trashed_page') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">Danh sách bài tin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->has('trashed_page') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}?trashed_page=1">Bài tin đã xóa</a>
        </li>
    </ul>

    <!-- Tìm kiếm và thêm mới -->
    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm bài tin..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm</button>
        </form>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm bài tin</a>
    </div>

    <!-- Bảng danh sách -->
    @if (!request()->has('trashed_page'))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Loại tin</th>
                    {{-- <th>Trạng thái</th> --}}
                    <th>Lượt xem</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        {{-- <td>{{ $post->status == 'published' ? 'Xuất bản' : 'Nháp' }}</td> --}}
                        <td>{{ $post->views }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
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
        {{ $posts->links() }}
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Loại tin</th>
                    {{-- <th>Trạng thái</th> --}}
                    <th>Ngày xóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trashedPosts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        {{-- <td>{{ $post->status == 'published' ? 'Xuất bản' : 'Nháp' }}</td> --}}
                        <td>{{ $post->deleted_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Bạn có chắc muốn khôi phục?')">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Không có bài tin nào đã xóa</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $trashedPosts->links('pagination::bootstrap-5', ['paginator' => $trashedPosts, 'pageName' => 'trashed_page']) }}
    @endif
@endsection