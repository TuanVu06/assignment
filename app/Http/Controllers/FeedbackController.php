<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function formFeedback()
    {
        return view('feedback.feedback_form');
    }
    //
    // File: app/Http/Controllers/PostController.php
    public function sendFeedback(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:gopy,phanhoi,hoptac',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240',
        ]);

        $data = $request->only(['type', 'name', 'email', 'message']);

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $filePath = $request->file('attachment')->getRealPath();
            $fileName = $request->file('attachment')->getClientOriginalName();
            $data['attachment'] = [
                'path' => $filePath,
                'name' => $fileName,
            ];
        }

        // $adminEmail = env('ADMIN_EMAIL', 'default@example.com');
        Mail::to('vutrinhphamtuan@gmail.com')->send(new FeedbackMail($data));

        return response()->json(['success' => 'Email đã được gửi thành công!']);
    }
}
