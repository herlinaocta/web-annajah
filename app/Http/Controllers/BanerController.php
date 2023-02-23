<?php

namespace App\Http\Controllers;

use App\Baner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Baner::all();

        return view('admin.baners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.baners.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required',
        ]);

        $gambar = $request->file('gambar');
        $new_gambar = time().$gambar->getClientOriginalName();

        $baner = new Baner;
        $baner->gambar = $new_gambar;
        $baner->link = $request->link;
        $baner->save();

        $gambar->move(public_path('assets/baner'), $new_gambar);

        return redirect()->route('baner.index')
            ->with('success', 'Baner created successfully.');
    }

    public function show($id)
    {
        $baner = Baner::find($id);

        return view('admin.baners.show', compact('baner'));
    }

    public function edit($id)
    {
        $baner = Baner::find($id);

        return view('admin.baners.edit', compact('baner'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'link' => 'required',
        ]);

        $baner = Baner::find($id);

        if ($request->has('gambar')) {
            $gambar = $request->file('gambar');
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move(public_path('assets/baner'), $new_gambar);
            Storage::delete('assets/baner/' . $baner->gambar);
            $baner->gambar = $new_gambar;
        }

        $baner->link = $request->link;
        $baner->save();

        return redirect()->route('baner.index')
            ->with('success', 'Baner updated successfully');
    }

    public function destroy($id)
    {
        $baner = Baner::find($id);

        Storage::delete('assets/slider/' . $baner->gambar);

        $baner->delete();

        return redirect()->route('baner.index')
            ->with('success', 'Baner deleted successfully');
    }
}