<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();
        $articlesCount = Article::count();
        $teachersCount = Teacher::count();
        $majorsCount = Major::count();
        $recentMessages = ContactMessage::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'unreadMessagesCount',
            'articlesCount',
            'teachersCount',
            'majorsCount',
            'recentMessages'
        ));
    }
}
