<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SelfieUploadController extends Controller
{
    public function create() {
        return Inertia::render('SingleMediaSelfieUpload');
    }


    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->file('images') as $image) {

            // Auto generate unique name
            $image->store('selfies', 'public');

            // OR custom name:
            // $filename = time().'_'.$image->getClientOriginalName();
            // $image->storeAs('selfies', $filename, 'public');
        }

        return redirect()->route('selfie')
                 ->with('success', 'Images uploaded successfully!');
    }
}
