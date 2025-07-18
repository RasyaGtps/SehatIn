<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        $articles = Article::when($query, function($q) use ($query) {
            return $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
        })
        ->latest()
        ->paginate(6);
        
        return view('education.index', compact('articles', 'query'));
    }

    public function show(Article $article)
    {
        // Get recent articles except current article
        $recentArticles = Article::where('id', '!=', $article->id)
                                ->latest()
                                ->take(5)
                                ->get();

        return view('education.show', compact('article', 'recentArticles'));
    }
} 