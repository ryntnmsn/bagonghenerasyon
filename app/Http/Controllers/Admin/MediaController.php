<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request) {

        $medias = Media::orderBy('created_at', 'desc')
            ->when($request->search, function($query) use ($request)  {
                $query->where('title', 'like', '%' . $request->search . '%');
        })->paginate(20)->withQueryString();

        return Inertia::render('Admin/Media/Media', [
            'medias' => $medias
        ]);
    }


    public function create() {
        return Inertia::render('Admin/Media/MediaCreate');
    }
    

    public function store(Request $request) {

        $request->validate([
            'title' => ['required', 'min:3', 'max:255', 'unique:media,title'],
            'images.*' => ['required', 'image', 'max:4000']
        ]);

        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $paths[] = $image->store('images', 'public');
            }
        }

        foreach ($request->file('images') as $image) {
            $image->store('images', 'public');
        }

        Media::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => $request->status,
            'images' => $paths,
        ]);

        return redirect()->route('media.index')->with('success', 'Media successfully saved');

    }

    public function edit($id) {

        $media = Media::findOrfail($id);
        
        return Inertia::render('Admin/Media/MediaEdit', [
            'media' => $media
        ]);
    }


    public function update(Request $request, $id) {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255', 'unique:articles,title,' . $id,],
            'images.*' => ['required', 'image', 'max:4000'],
            'removed_images' => ['array']
        ]);

        $media = Media::findOrFail($id);

        $images = $media->images ?? [];

        if ($request->removed_images) {
            foreach ($request->removed_images as $removed) {
                Storage::disk('public')->delete($removed);
                $images = array_values(array_diff($images, [$removed]));
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('images', 'public');
            }
        }

        $media->title = $request->title;
        $media->description = $request->description;
        $media->status = $request->status;
        $media->images = $images;

        $media->update();

         return back()->with('success', 'Media updated successfully');

    }


    public function destroy($id) {
        $media = Media::findOrFail($id);

        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully');
    }
}
