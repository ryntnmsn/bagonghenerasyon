<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Media;
use App\Models\Banner;
use App\Models\Article;
use App\Models\Subscription;
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
            'articleCategories' => $articleCategories,
            'subscriptionMessage' => session('subscriptionMessage', ''),
        ])->withViewData([
            'meta' => [
                'title' => 'Bagong Henerasyon Partylist',
                'description' => 'Lead the fight against sickness, ignorance, poverty, and indifference by
empowering individuals with knowledge and skills. Achieve a healthy, educated, prosperous and empowered citizenry and our goals is to comprehensively implement continuous and sustainable programs through its H.E.L.P.S. advocacies.',
                'image' => asset('storage/images/og-image.jpg')
            ],
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



    public function about() {
        return Inertia::render('About');
    }


    public function media() {

        $medias = Media::where('status', true)->latest()->paginate(15);

        return Inertia::render('Media', [
            'medias' => $medias
        ]);
    }


    public function single_media($slug) {

        $media = Media::where('slug', $slug)->first();

        return Inertia::render('SingleMedia', [
            'media' => $media
        ]);
    }


    public function subscription(Request $request) {
        $request->validate([
            'email' => ['email', 'min:6', 'max:255']
        ]);

        Subscription::create([
            'email' => $request->email
        ]);

        return back()->with('subscriptionMessage', 'Thank you for subscribing to our newsletter. Please check your email for updates and announcements.');

    }


    public function search(Request $request) {
        $query = $request->q;

        $results  = Article::where('title', 'like', "%{$query}%")
            ->orWhere('short_description', 'like', "%{$query}%")
            ->latest()
            ->get();

            return Inertia::render('Search', [
                'query' => $query,
                'results' => $results
            ]);

    }

}
