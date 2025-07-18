<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Get latest 3 articles for welcome page
     */
    public function getLatestArticles()
    {
        try {
            $articles = Article::latest()->take(3)->get();
            
            $articles = $articles->map(function($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'description' => Str::limit($article->description, 100),
                    'image_url' => url('storage/' . $article->image)
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil artikel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'required|string'
            ]);

            // Generate unique ID untuk nama file
            $fileId = Str::ulid();
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            
            // Format nama file: [ULID].[extension]
            $imageName = $fileId . '.' . $extension;
            $path = 'articles/' . $imageName;

            // Simpan file langsung ke storage/app/public/articles
            $image->move(storage_path('app/public/articles'), $imageName);

            $article = Article::create([
                'title' => $request->title,
                'image' => $path,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Artikel berhasil ditambahkan',
                'data' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'description' => $article->description,
                    'image_url' => url('storage/' . $article->image),
                    'created_at' => $article->created_at,
                    'updated_at' => $article->updated_at
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan artikel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Hapus gambar lama
            if ($article->image) {
                Storage::delete('public/' . $article->image);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/articles', $imageName);
            $data['image'] = 'articles/' . $imageName;
        }

        $article->update($data);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::delete('public/' . $article->image);
        }
        
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
