<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\ArticleType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request) {

        $articles = Article::with(['category:id,title', 'user:id,first_name,last_name', 'type:id,title'])
            ->orderBy('created_at', 'desc')
            ->when($request->search, function($query) use ($request)  {
                $query->where('title', 'like', '%' . $request->search . '%');
        })->paginate(20)->withQueryString();

        return Inertia::render('Admin/Articles/Articles', [
            'articles' => $articles,
            'searchTerm' => $request->search
        ]);
    }


    public function create(){
        $articleCategories = ArticleCategory::select('id', 'title')->get();
        $articleTypes = ArticleType::select('id', 'title')->get();

        return Inertia::render('Admin/Articles/ArticlesCreate', [
            'articleCategories' => $articleCategories,
            'articleTypes' => $articleTypes
        ]);
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'title' => ['required', 'min:6', 'max:255', 'unique:articles,title'],
            'description' => ['required'],
            'short_description' => ['required', 'min:6'],
            'article_category_id' => ['required'],
            'article_type_id' => ['required'],
            'status' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:250']
        ]);

         if($request->hasFile('image')) {
            $validatedData['image'] = Storage::disk('public')->put('images', $request->image);
         }

        $userId = Auth::id();

        Article::create([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'description' => $validatedData['description'],
            'user_id' => $userId,
            'short_description' => $validatedData['short_description'],
            'article_category_id' => $validatedData['article_category_id'],
            'article_type_id' => $validatedData['article_type_id'],
            'status' => $validatedData['status'],
            'image' => $validatedData['image']
        ]); 

        return redirect()->route('articles.index')->with('success', 'Article created successfully');

    }


    public function edit(String $id) {

        $article = Article::find($id);
        $articleCategories = ArticleCategory::select('id', 'title')->get();
        $articleTypes = ArticleType::select('id', 'title')->get();

        return Inertia::render('Admin/Articles/ArticlesEdit', [
            'article' => array_merge(
                $article->toArray(),
                [
                    'image_url' => $article->image
                        ? asset('storage/' . $article->image)
                        : null,
                ]
            ),
            'articleCategories' => $articleCategories,
            'articleTypes' => $articleTypes,
            
        ]);

    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:6', 'max:255', 'unique:articles,title,' . $id,],
            'description' => ['required'],
            'short_description' => ['required', 'min:6'],
            'article_category_id' => ['required'],
            'article_type_id' => ['required'],
            'status' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:250'],
        ]);

        $article = Article::findOrFail($id);

        $article->title = $request->title;
        $article->description = $request->description;
        $article->short_description = $request->short_description;
        $article->article_category_id = $request->article_category_id;
        $article->article_type_id = $request->article_type_id;
        $article->status = $request->status;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $article->image = $path;
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article updated successfully');
    }


    public function destroy($id) {

        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');

    }

}
