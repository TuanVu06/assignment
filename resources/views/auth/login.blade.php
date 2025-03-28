@extends('layout.app')

@section('title', 'Đăng nhập - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Đăng nhập tài khoản</h2>

                    <!-- Thông báo thành công hoặc lỗi -->
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

                    <!-- Thông báo lỗi validation -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form đăng nhập -->
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </div>
                    </form>

                    <!-- Liên kết quên mật khẩu và đăng ký -->
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('password.request') }}" class="text-primary">Quên mật khẩu?</a>
                        <span>
                            Chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary">Đăng ký tại đây</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection