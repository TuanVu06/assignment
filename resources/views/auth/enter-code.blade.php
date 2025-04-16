@extends('layout.app')

@section('title', 'Xác minh mã - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Xác minh mã</h2>

                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <!-- Verification Form -->
                    <form method="POST" action="{{ route('password.code.verify') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', session('email') ?? '') }}" readonly  required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã xác minh 6 chữ số</label>
                            <input type="text" name="code" id="code" class="form-control" 
                                   placeholder="Nhập mã xác minh" required maxlength="6" pattern="\d{6}">
                            <small class="text-muted">Vui lòng nhập mã 6 chữ số đã được gửi đến email của bạn</small>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Xác minh</button>
                            <a href="{{ route('password.request') }}" class="btn btn-outline-secondary">Gửi lại mã</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection