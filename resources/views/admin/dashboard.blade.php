<!-- resources/views/admin/dashboard.blade.php -->
@extends('admin.layout.app')

@section('content')
    <h1 class="mb-4">Dashboard Quản trị Tin tức</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Quản trị loại tin</h5>
                    <p class="card-text">Quản lý danh mục tin tức (Thể thao, Công nghệ, v.v.).</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Quản trị tin</h5>
                    <p class="card-text">Quản lý bài tin tức (thêm, sửa, xóa bài viết).</p>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
@endsection