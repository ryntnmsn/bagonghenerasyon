<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use Inertia\Inertia;

class ArticleCategoryController extends Controller
{

    public function index(Request $request) {

        $articleCategories = ArticleCategory::when($request->search, function($query) use ($request)  {
            $query->where('title', 'like', '%' . $request->search . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/ArticleCategory/ArticleCategory', [
            'articleCategories' => $articleCategories,
            'searchTerm' => $request->search
        ]);
    }


    public function create() {
        return Inertia::render('Admin/ArticleCategory/ArticleCategoryCreate');
    }


    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255', 'unique:article_categories,title'],
        ]);

        ArticleCategory::create([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']),
            'description' => $request['description'],
        ]);

        return redirect()->route('article_categories.create')->with('success', 'Article category successfully created.');
    }


    public function edit(String $id) {
        $articleCategories = ArticleCategory::find($id);

        return Inertia::render('Admin/ArticleCategory/ArticleCategoryEdit', [
            'articleCategories' => $articleCategories
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => ['required', 'max:255'],
        ]);

        $articleCategories = ArticleCategory::find($id);

        $articleCategories->title = $request->title;
        $articleCategories->description = $request->description;
        $articleCategories->save();

        return redirect()->route("article_categories.index")->with('success', 'Article category updated successfully.');
        
    }


    public function destroy($id) {
        $articleCategories = ArticleCategory::findOrFail($id);
        
        $articleCategories->delete();

        return redirect()->route('article_categories.index')->with('success', 'Article category deleted successfully.');
    }
}
    