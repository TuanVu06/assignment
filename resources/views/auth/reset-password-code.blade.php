@extends('layout.app')

@section('content')
    <h1>Reset Password</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('password.new.reset') }}">
        @csrf
        <input type="email" name="email" value="{{ session('email') }}" readonly>
        <input type="text" name="code" placeholder="Enter 6-digit code" required>
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Reset Password</button>
    </form>
@endsection
