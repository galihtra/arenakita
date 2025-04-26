<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
        $galleries = auth()->user()->galleries;
        return view('galleries.index', compact('galleries'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGalleryRequest $request)
    {
        // $this->validate($request, [
        //     'caption' => 'required',
        //     'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048'
        // ]);
        if($request->hasFile('image')) {
            $data = $request->validated();
            $gallery = auth()->user()->galleries()->create([
                'caption' => $request->input('caption'),
                'image' => $request->file('image')->store('galleries', 'public')
            ]);
    
            return redirect()->route('galleries.index');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $path = $gallery->image;

        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $path =  $request->file('image')->store('galleries', 'public');
        }

        $gallery->update([
            'caption' => $request->input('caption'),
            'image' => $path
        ]);

        return redirect()->route('galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->image);
        $gallery->delete();
        return back();
    }
}
