<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\GalleryImage;


class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {

        // dd($request->images);
         $request->validate([
            'title' => 'required|string',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $gallery = Gallery::create([
            'title' => $request->input('title'),
        ]);

        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('gallery_images', 'public');
            $gallery->images()->create(['path' => $imagePath]);
        }

        return redirect()->route('galleries.index')->with('success', 'Gallery created successfully');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'images' => 'array', // Allow updating images, but it's optional
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);

        $gallery = Gallery::findOrFail($id);
        $gallery->update([
            'title' => $request->input('title'),
        ]);

        if ($request->hasFile('images')) {
            // Handle image updates (if any)
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('gallery_images', 'public');
                $gallery->images()->create(['path' => $imagePath]);
            }
        }

        if ($request->has('delete_images')) {
            // Handle image deletions (if any)
            foreach ($request->input('delete_images') as $imageId) {
                // Find and delete the image from the gallery
                $image = GalleryImage::findOrFail($imageId);
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete associated images from storage (if any)
        foreach ($gallery->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully');
    }

}