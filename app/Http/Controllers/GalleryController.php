<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::orderBy('created_at', 'desc')->get();
        return view('gallery.index')->with('images', $images);
    }

    public function postNewImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $name = uniqid() . '.' . $request->file('image')->guessClientExtension();
        $original_name = $request->file('image')->getClientOriginalName();
        $path = 'img/gallery/'.$name;
        $extension = $request->file('image')->guessClientExtension();

        $request->file('image')->move('img/gallery', $name);

        Gallery::create([
            'name' => $name,
            'original_name' => $original_name,
            'extension' => $extension,
            'path' => $path,
        ]);

        notify()->flash('Slika uspješno dodana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('gallery.index');
    }

    public function getDeleteImage(Gallery $image)
    {
        unlink(public_path($image->path));
        $image->delete();

        notify()->flash('Slika uspješno obrisana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('gallery.index');
    }
}
