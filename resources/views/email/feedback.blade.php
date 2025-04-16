<!-- resources/views/emails/feedback.blade.php -->
<h1>{{ $data['type'] == 'gopy' ? 'Góp ý' : ($data['type'] == 'phanhoi' ? 'Phản hồi' : 'Yêu cầu hợp tác') }}</h1>
<p><strong>Họ tên:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Nội dung:</strong> {{ $data['message'] }}</p>
{{-- @if (isset($data['attachment']))
    <p><strong>File đính kèm:</strong> {{ $data['attachment']['name'] }}</p>
@endif --}}