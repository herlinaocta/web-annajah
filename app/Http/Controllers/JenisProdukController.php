<?php

namespace App\Http\Controllers;

use App\JenisProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisProduks = JenisProduk::all();

        return view('admin.jenis_produk.index', compact('jenisProduks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis_produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:jenis_produks,nama'
        ]);
    
        $jenisProduk = new JenisProduk();
        $jenisProduk->nama = $validatedData['nama'];
        $jenisProduk->slug = Str::slug($validatedData['nama'], '-');
        $jenisProduk->save();
    
        return redirect()->route('jenis_produk.index')->with('success', 'Jenis produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisProduk  $jenisProduk
     * @return \Illuminate\Http\Response
     */
    public function show($jenis_produk)
    {
        $jenisProduk = JenisProduk::where('slug', $jenis_produk)->firstOrFail();
        return view('admin.jenis_produk.show', compact('jenisProduk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisProduk  $jenisProduk
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $jenisProduk = JenisProduk::where('slug', $slug)->first();

        return view('admin.jenis_produk.edit', compact('jenisProduk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisProduk  $jenisProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $jenisProduk = JenisProduk::where('slug', $slug)->first();
        $rules = [
            'nama' => 'required|unique:jenis_produks,nama,' . $jenisProduk->id
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('jenis_produk.edit', $jenisProduk->slug)->withErrors($validator)->withInput();
        }

        $jenisProduk->nama = $request->input('nama');
        $jenisProduk->slug = $request->input('slug') ?: Str::slug($request->input('nama'), '-');
        $jenisProduk->save();

        return redirect()->route('jenis_produk.show', $jenisProduk->slug)->with('success', 'Data jenis produk berhasil diupdate.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisProduk  $jenisProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $jenisProduk = JenisProduk::where('slug', $slug)->firstOrFail();
        $jenisProduk->delete();

        return redirect()->route('jenis_produk.index');
    }
}
