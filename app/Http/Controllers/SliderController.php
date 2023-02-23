<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required',
        'title2' => 'required',
        'link' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle the file upload
    if ($request->hasFile('gambar')) {
        $new_gambar = time() . $request->gambar->getClientOriginalName();
        $request->gambar->move(public_path('assets/slider'), $new_gambar);
    }

    // Create a new slider using the request data and the generated slug
    $slider = new Slider([
        'title' => $validatedData['title'],
        'title2' => $validatedData['title2'],
        'link' => $validatedData['link'],
        'gambar' => $new_gambar ?? '',
        'slug' => Str::slug($validatedData['title'], '-') . '-' . Str::random(5),
    ]);

    // Save the slider to the database
    $slider->save();

    // Redirect to the index page with a success message
    return redirect()->route('admin.sliders.index')->with('success', 'Slider added successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
{
    $request->validate([
        'title' => 'required',
        'title2' => 'required',
        'link' => 'required|url',
        'gambar' => 'nullable|image',
    ]);

    $slider = Slider::where('slug', $slug)->firstOrFail();

    $slider->title = $request->input('title');
    $slider->title2 = $request->input('title2');
    $slider->slug = Str::slug($request->input('title'));
    $slider->link = $request->input('link');

    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $gambar_name = time() . '_' . $gambar->getClientOriginalName();
        $gambar_path = $gambar->storeAs('slider', $gambar_name, 'public');
        $slider->gambar = $gambar_path;
    }

    $slider->save();

    return redirect()->route('admin.sliders.index')
                     ->with('success', 'Slider updated successfully');
}


public function destroy($slug)
{
    $slider = Slider::where('slug', $slug)->firstOrFail();
    Storage::disk('public')->delete($slider->gambar);
    $slider->delete();

    return redirect()->route('admin.sliders.index')
                     ->with('success', 'Slider deleted successfully');
}

}