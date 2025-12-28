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


    //Articles
    public function articles() {
        $articles = Article::with('category')->latest()->paginate(12);
        return Inertia::render('Articles', [
            'articles' => $articles
        ]);
    }


    //Single Article Category
    public function single_article_category(String $slug) {
        $category = ArticleCategory::whereSlug($slug)
        ->firstOrFail();

        $articles = $category->articles()
            ->with('category')
            ->latest()
            ->paginate(12);

        return Inertia::render('SingleArticleCategory', [
            'articles' => $articles,
            'category' => $category
        ]);
    }

    //Single Article
    public function single_article(String $slug) {

        $article = Article::with('category')
            ->whereSlug($slug)
            ->firstOrFail();

        $latestArticles = Article::select('id', 'title', 'slug', 'image') 
            ->whereKeyNot($article->id)
            ->latest()
            ->take(5)
            ->get();

        $relatedArticles = Article::with('category')->select('id', 'title', 'slug', 'image', 'short_description', 'article_category_id') 
            ->where('article_category_id', $article->article_category_id)    
            ->whereKeyNot($article->id)
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('SingleArticle', [
            'article' => $article,
            'latestArticles' => $latestArticles,
            'relatedArticles' => $relatedArticles
        ]);

    }



}
