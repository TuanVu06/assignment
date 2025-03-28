@extends('layout.app')

@section('title', 'Đặt lại mật khẩu - Website Tin Tức')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center mb-4 text-primary">Đặt lại mật khẩu</h2>

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

                    <!-- Password Reset Form -->
                    <form method="POST" action="{{ route('password.new.reset') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        
                        <div class="mb-3">
                            <p class="form-control-static">Email: <strong>{{ session('email') }}</strong></p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Nhập mật khẩu mới" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                                   placeholder="Nhập lại mật khẩu mới" required>
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