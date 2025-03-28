@extends('layout.app')

@section('title', 'Quên mật khẩu - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Quên mật khẩu</h2>

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
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Password Reset Form -->
                    <form method="POST" action="{{ route('password.code.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Nhập email đã đăng ký" value="{{ old('email') }}" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Gửi mã xác nhận</button>
                        </div>
                    </form>

                    <!-- Back to Login Link -->
                    <p class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-primary">Quay lại trang đăng nhập</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection