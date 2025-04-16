@extends('layout.app')

@section('title', 'Đặt lại mật khẩu - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Đặt lại mật khẩu</h2>

                    <!-- Hiển thị thông báo lỗi chung (nếu có) -->
                    @if (session('error'))
                        <div style="color: red;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Hiển thị thông báo thành công (nếu có) -->
                    @if (session('success'))
                        <div style="color: green;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Password Reset Form -->
                    <form method="POST" action="{{ route('password.new.reset') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            @if ($email)
                                <p class="form-control-static">Email: <strong>{{ $email }}</strong></p>
                            @else
                                <p class="form-control-static text-danger">Không tìm thấy email. Vui lòng bắt đầu lại.</p>
                            @endif
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Nhập mật khẩu mới"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Nhập lại mật khẩu mới" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
