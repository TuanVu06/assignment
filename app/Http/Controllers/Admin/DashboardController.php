<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $postCount = Post::count();
        $userCount = User::count();
        // $feedbackCount = Feedback::count();

        return view('admin.dashboard', compact('postCount', 'userCount'));
    }
}
