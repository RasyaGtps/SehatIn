<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Users
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $latestUsers = User::latest()->take(5)->get();

        // Statistik Articles
        $totalArticles = Article::count();
        $articlesThisMonth = Article::whereMonth('created_at', Carbon::now()->month)->count();
        $latestArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'latestUsers',
            'totalArticles',
            'articlesThisMonth',
            'latestArticles'
        ));
    }
}
