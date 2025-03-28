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
            return back()->with('error', 'Có lỗi xảy ra khi gửi mã xác nhận');
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

            return redirect()->route('password.new.form')
                ->with('email', $request->email)
                ->with('success', 'Xác thực thành công, vui lòng đặt mật khẩu mới');

        } catch (\Exception $e) {
            Log::error('Verify code error: '.$e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi xác thực mã');
        }
    }

    // Hiển thị form đặt mật khẩu mới
    public function showNewPasswordForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request')->with('error', 'Vui lòng xác thực email trước');
        }
        return view('auth.new-password');
    }

    // Xử lý đổi mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        try {
            // Kiểm tra xem email có trong bảng reset không
            $exists = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->exists();
    
            if (!$exists) {
                return redirect()->route('password.new.form')
                    ->withInput() // Giữ lại input cũ
                    ->with('email', $request->email) // Giữ lại email
                    ->with('error', 'Phiên đặt lại mật khẩu không hợp lệ');
            }
    
            // Cập nhật mật khẩu
            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
    
            // Xóa token reset
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();
    
            // Xóa session
            $request->session()->forget(['email']);
    
            // Chuyển hướng về login với thông báo
            return redirect()->route('login')
                ->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập');
    
        } catch (\Exception $e) {
            Log::error('Reset password error: '.$e->getMessage());
            return redirect()->route('password.new.form')
                ->withInput() // Giữ lại input cũ
                ->with('email', $request->email) // Giữ lại email
                ->with('error', 'Có lỗi xảy ra khi đặt lại mật khẩu: '.$e->getMessage());
        }
    }
}