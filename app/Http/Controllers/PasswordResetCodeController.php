<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Mail\ResetPasswordCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class PasswordResetCodeController extends Controller
{
    // Hiển thị form nhập email
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Gửi mã xác nhận
    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        
        try {
            $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $email = $request->email;

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $email],
                ['token' => $code, 'created_at' => Carbon::now()]
            );

            Mail::to($email)->send(new ResetPasswordCodeMail($code));

            return redirect()->route('password.code.form')
                ->with('success', 'Mã xác nhận đã được gửi đến email của bạn!')
                ->with('email', $email);

        } catch (\Exception $e) {
            Log::error('Send reset code error: '.$e->getMessage());
            return back()
                ->withInput()
                ->with('email', $request->email)
                ->with('error', 'Có lỗi xảy ra khi gửi mã xác nhận.');
        }
    }

    // Hiển thị form nhập mã
    public function showCodeForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request')->with('error', 'Vui lòng nhập email trước');
        }
        return view('auth.enter-code');
    }

    // Xác nhận mã
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        try {
            $reset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->code)
                ->where('created_at', '>', Carbon::now()->subMinutes(30))
                ->first();

            if (!$reset) {
                return redirect()->route('password.code.form')
                    ->with('error', 'Mã không hợp lệ hoặc đã hết hạn')
                    ->with('email', $request->email);
            }

            // Lưu token vào cookie (hết hạn sau 30 phút, khớp với thời gian sống của token)
            return redirect()->route('password.new.form', ['token' => $reset->token])
                ->with('success', 'Xác thực thành công, vui lòng đặt mật khẩu mới.')
                ->cookie('reset_token', $reset->token, 30);

        } catch (\Exception $e) {
            Log::error('Verify code error: '.$e->getMessage());
            return redirect()->route('password.code.form')
                ->withInput()
                ->with('email', $request->email)
                ->with('error', 'Có lỗi xảy ra khi xác thực mã.');
        }
    }

    // Hiển thị form đặt mật khẩu mới
    public function showNewPasswordForm()
    {
        // Lấy token từ URL, cookie, hoặc hidden input
        $token = Cookie::get('reset_token');
        if (!$token) {
            return redirect()->route('password.request')
                ->with('error', 'Phiên xác thực không hợp lệ. Vui lòng bắt đầu lại.');
        }

        // Lấy email từ bảng password_reset_tokens dựa trên token
        $reset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subMinutes(30))
            ->first();

            if (!$reset) {
                // Xóa cookie nếu token không hợp lệ
                Cookie::queue(Cookie::forget('reset_token'));
                return redirect()->route('password.request')
                    ->with('error', 'Phiên xác thực đã hết hạn. Vui lòng bắt đầu lại.');
            }
    
            $email = $reset->email;
    
            return view('auth.new-password', compact('email', 'token'));
    }

    // Xử lý đổi mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'token.required' => 'Phiên xác thực không hợp lệ.',
        ]);
    
        try {
            // Kiểm tra token và email trong bảng reset
            $reset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->where('created_at', '>', Carbon::now()->subMinutes(30))
                ->first();
    
                if (!$reset) {
                    // Xóa cookie nếu token không hợp lệ
                    Cookie::queue(Cookie::forget('reset_token'));
                    return redirect()->route('password.new.form', ['token' => $request->token])
                        ->withInput()
                        ->with('error', 'Phiên đặt lại mật khẩu không hợp lệ.');
                }
    
            // Cập nhật mật khẩu
            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
    
            // Xóa token reset
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();
    
            // Xóa cookie reset_token
            Cookie::queue(Cookie::forget('reset_token'));
    
            // Chuyển hướng về login với thông báo
            return redirect()->route('login')
                ->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập');
    
        } catch (\Exception $e) {
            Log::error('Reset password error: '.$e->getMessage());
            return redirect()->route('password.new.form')
                ->withInput() // Giữ lại input cũ
                // ->with('email', $request->email) // Giữ lại email
                ->with('error', 'Có lỗi xảy ra khi đặt lại mật khẩu: '.$e->getMessage());
        }
    }
}