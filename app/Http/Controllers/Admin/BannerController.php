<?php

namespace App\Http\Controllers\Admin;
use Inertia\Inertia;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request){

        $banners = Banner::when($request->search, function($query) use ($request)  {
            $query->where('title', 'like', '%' . $request->search . '%');
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Banners/Banners', [
            'banners' => $banners,
            'searchTerm' => $request->search
        ]);
    }

    public function create() {
        return Inertia::render('Admin/Banners/BannersCreate');
    }

    public function store(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'title' => ['required', 'min:6', 'max:255'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'],
            'link' => ['nullable'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:512']
        ]);

         if($request->hasFile('image')) {
            $validatedData['image'] = Storage::disk('public')->put('images', $request->image);
         }

        Banner::create([
            'title' => $validatedData['title'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'status' => $validatedData['status'],
            'link' => $validatedData['link'],
            'image' => $validatedData['image']
            
        ]); 

        return redirect()->route('banners.index')->with('success', 'Banner created successfully');
    }

    public function edit($id) {
        $banner = Banner::find($id);

        return Inertia::render('Admin/Banners/BannersEdit', [
            'banner' => array_merge(
                $banner->toArray(),
                [
                    'image_url' => $banner->image
                        ? asset('storage/' . $banner->image)
                        : null,
                ]
            )
        ]);

    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => ['required', 'min:6', 'max:255'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'],
            'link' => ['nullable'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:512']
        ]);

        $banner = Banner::findOrFail($id);

        $banner->title = $request->title;
        $banner->start_date = $request->start_date;
        $banner->end_date = $request->end_date;
        $banner->status = $request->status;
        $banner->link = $request->link;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $banner->image = $path;
        }

        $banner->update();

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully');
    }

    public function destroy($id) {
        $banner = Banner::findOrFail($id);

        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully');
    }
}
