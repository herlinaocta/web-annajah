<?php

namespace App\Http\Controllers;

use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size = Size::all();
        return view('admin.product.size.index', compact('size.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.size.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);

        $size = new Size;
        $size->kategori = $request->kategori;
        $size->slug = Str::slug($request->kategori, '-');
        $size->deskripsi = $request->deskripsi;

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/size/', $filename);
            $size->gambar = $filename;
        }

        $size->save();
        return redirect('/size')->with('success', 'Size has been added');
        session()->flash('message', 'Successfully added size!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $size = Size::where('slug', $slug)->firstOrFail();
            return view('admin.product.size.show', compact('size'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Size not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $size = Size::where('slug', $slug)->first();
        return view('admin.product.size.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //
    }
}
