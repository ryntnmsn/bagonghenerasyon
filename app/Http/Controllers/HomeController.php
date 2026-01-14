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
        ])->withViewData([
            'meta' => [
                'title' => 'News | Bagong Henerasyon Partylist',
                'description' => 'Official source of articles and news featuring the initiatives, programs, and advocacies of Bagong Henerasyon Partylist.',
                'image' => asset('storage/images/og-image.jpg')
            ],
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
        ])->withViewData([
            'meta' => [
                'title' => $category->title . ' | Bagong Henerasyon Partylist',
                'description' => $category->description,
                'image' => asset('storage/images/og-image.jpg')
            ],
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
        ])->withViewData([
            'meta' => [
                'title' => $article->title . ' | Bagong Henerasyon Partylist',
                'description' => $article->short_description,
                'image' => asset('storage/'. $article->image)
            ],
        ]);

    }



    public function about() {
        return Inertia::render('About')->withViewData([
            'meta' => [
                'title' => 'About | Bagong Henerasyon Partylist',
                'description' => 'The BAGONG HENERASYON is a non-stock, non-profit, non-government organization, a foundation and a party-list founded by Representative Bernadette “BH” Herrera-Dy.',
                'image' => asset('/storage/images/about_us_image.jpg')
            ],
        ]);
    }


    public function media() {

        $medias = Media::where('status', true)->latest()->paginate(15);

        return Inertia::render('Media', [
            'medias' => $medias
        ])->withViewData([
            'meta' => [
                'title' => 'Media | Bagong Henerasyon Partylist',
                'description' => 'Stay updated with the latest news, press releases, photos, videos, and official announcements from Bagong Henerasyon Partylist.',
                'image' => asset('/storage/images/about_us_image.jpg')
            ],
        ]);
    }


    public function single_media($slug) {

        $media = Media::where('slug', $slug)->first();

        $images = $media->images;
        $firstImage = is_array($images) && count($images)
        ? asset('/storage/' . $images[0])
        : asset('/storage/images/og-image.jpg');

        return Inertia::render('SingleMedia', [
            'media' => $media
        ])->withViewData([
            'meta' => [
                'title' => $media->title . ' | Bagong Henerasyon Partylist',
                'description' => $media->description,
                'image' => $firstImage
            ],
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
