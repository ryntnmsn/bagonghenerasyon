<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Banner;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class HomeController extends Controller
{
    public function index() {
        
        $banners = Banner::where('status', true)
        ->orderBy('created_at', 'desc')
        ->get();

        $latestArticles = Article::with(['category:id,title'])
        ->where('status', true)
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $featuredArticles = Article::with(['category:id,title'])
        ->where('status', true)
        ->inRandomOrder()
        ->take(4)
        ->get();

        $articleCategories = ArticleCategory::with('articles')->get();

        return Inertia::render('Home', [
            'banners' => $banners,
            'latestArticles' => $latestArticles,
            'featuredArticles' => $featuredArticles,
            'articleCategories' => $articleCategories
        ]);
    }
}
