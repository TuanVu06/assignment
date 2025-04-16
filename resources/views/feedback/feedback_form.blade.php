@extends('layout.app')

@section('title', $post->title)

@section('content')

<!-- resources/views/emails/feedback_form.blade.php -->
<form action="{{ route('send.feedback') }}" method="POST">
    @csrf
    <div>
        <label for="type">Loại nội dung:</label>
        <select name="type" id="type" required>
            <option value="feedback">Phản hồi</option>
            <option value="opinion">Ý kiến</option>
            <option value="collaboration">Yêu cầu hợp tác</option>
        </select>
    </div>
    <div>
        <label for="name">Họ tên:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <div>
        <label for="message">Nội dung:</label>
        <textarea name="message" id="message" required></textarea>
    </div>
    <button type="submit">Gửi</button>
</form>

@endsection