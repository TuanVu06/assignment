@extends('layout.app')

@section('title', $post->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <!-- Hiển thị hình ảnh -->
                @if($post->image)
                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                @else
                {{-- <img src="{{ asset('images/default-post.jpg') }}" class="card-img-top" alt="Default post image" style="max-height: 400px; object-fit: cover;"> --}}
                @endif
                
                <div class="card-body">
                    <!-- Tiêu đề bài viết -->
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>
                    
                    <!-- Thông tin meta -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="badge bg-primary">{{ $post->category->name }}</span>
                        <small class="text-muted">Đăng ngày: {{ $post->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <p></p>
                    <!-- Nội dung bài viết -->
                    <div class="post-content mb-4">
                        {!! $post->content !!}
                    </div>
                    
                    <!-- Nút quay lại -->
                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .post-content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 0.25rem;
    }
    
    .post-content p {
        margin-bottom: 1rem;
        line-height: 1.8;
    }
    
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
</style>
@endsection