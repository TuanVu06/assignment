@extends('layout.app')

@section('title', 'Trang chủ - Website Tin Tức')

@section('content')
    <!-- Bài viết nổi bật -->
    @if ($featuredPost)
        <div class="mb-5">
            <h2 class="border-bottom pb-2 mb-4 text-primary">Bài viết nổi bật</h2>
            <div class="card shadow-sm border-0 rounded-3 featured-post">
                <div class="row g-0">
                    @if ($featuredPost->image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' .$featuredPost->image) }}" class="img-fluid rounded-start" alt="{{ $featuredPost->title }}" style="object-fit: cover; height: 100%;">
                        </div>
                    @endif
                    <div class="col-md-{{ $featuredPost->image ? '8' : '12' }}">
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="{{ route('posts.show', $featuredPost->id) }}" class="text-decoration-none text-dark">
                                    {{ $featuredPost->title }}
                                </a>
                            </h3>
                            <p class="text-muted mb-2">
                                <small>
                                    <span class="badge bg-primary">{{ $featuredPost->category->name }}</span> | 
                                    {{ $featuredPost->created_at->format('d/m/Y H:i') }} | 
                                    <i class="bi bi-eye"></i> {{ $featuredPost->views }} lượt xem
                                </small>
                            </p>
                            <p class="card-text">{!! Str::limit(strip_tags($featuredPost->content), 200) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Danh sách bài viết -->
    <div class="mb-5">
        <h2 class="border-bottom pb-2 mb-4 text-primary">Danh sách bài viết</h2>
        @if ($posts->isEmpty())
            <p class="text-muted">Chưa có bài viết nào.</p>
        @else
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 rounded-3 h-100 post-card">
                            @if ($post->image)
                                <img src="{{ asset('storage/' .$post->image) }}" class="card-img-top rounded-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="text-muted mb-2">
                                    <small>
                                        <span class="badge bg-primary">{{ $post->category->name }}</span> | 
                                        {{ $post->created_at->format('d/m/Y H:i') }} | 
                                        <i class="bi bi-eye"></i> {{ $post->views }} lượt xem
                                    </small>
                                </p>
                                <p class="card-text">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Phân trang -->
            <div class="mt-4">
                {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection