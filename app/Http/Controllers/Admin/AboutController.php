<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use Illuminate\Http\Request;

error_reporting(0);

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $about = About::first();

        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {

      $about = About::first();
      $about->judul = $request->judul;
      $about->deskripsi = $request->deskripsi;
  
      if($request->hasFile('gambar')) {
          $file = $request->file('gambar');
          $extension = $file->getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $file->move('assets/about/', $filename);
          $about->gambar = $filename;
      }
  
      if($request->hasFile('video')) {
          $file = $request->file('video');
          $extension = $file->getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $file->move('assets/about/', $filename);
          $about->video = $filename;
      }
  
      $about->save();
      return redirect('/admin-about')->with('success', 'About berhasil diupdate');


    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}

