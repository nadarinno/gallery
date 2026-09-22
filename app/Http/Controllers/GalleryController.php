<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
{
    $images = GalleryImage::where('user_id', Auth::id())
        ->latest()
        ->paginate(6);

    return view('gallery.index', compact('images'));
}

    public function storeSingle(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $file = $request->file('image');

        $path = $file->store('gallery', 'public');

        GalleryImage::create([
            'user_id' => Auth::id(),
            'image_path' => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Image uploaded successfully.');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->file('images') as $file) {

            $path = $file->store('gallery', 'public');

            GalleryImage::create([
                'user_id' => auth()->id(),
                'image_path' => $path,
                'original_name' => $file->getClientOriginalName(),
            ]);
        }

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Images uploaded successfully.');
    }

    public function show($id)
    {
        $image = GalleryImage::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('gallery.show', compact('image'));
    }

    public function destroy($id)
    {
        $image = GalleryImage::where('user_id', auth()->id())
            ->findOrFail($id);

        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Image deleted successfully.');
    }
}