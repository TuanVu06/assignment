@extends('layout.app')

@section('title', 'Đăng ký - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Đăng ký tài khoản</h2>

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

                    <!-- Form đăng ký -->
                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ và tên" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>

                    <!-- Liên kết đến trang đăng nhập -->
                    <p class="text-center mt-3">
                        Đã có tài khoản? <a href="{{ route('login') }}" class="text-primary">Đăng nhập tại đây</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection