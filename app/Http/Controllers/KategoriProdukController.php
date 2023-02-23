<?php

namespace App\Http\Controllers;

use App\KategoriProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriProduks = KategoriProduk::all();
        return view('admin.kategori_produk.index', compact('kategoriProduks'));
    }

    public function create()
    {
        return view('admin.kategori_produk.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required',
        'gambar' => 'required|image',
        'icon' => 'required|image',
        'size' => 'required',
    ]);

    $kategoriProduk = new KategoriProduk();

    $kategoriProduk->nama = $validatedData['nama'];
    $kategoriProduk->slug = Str::slug($validatedData['nama']);
    $kategoriProduk->size = $validatedData['size'];

    // simpan gambar
    $gambar = $request->file('gambar');
    $gambarName = time() . '-' . $gambar->getClientOriginalName();
    $gambar->move(public_path('assets/' . $validatedData['size']), $gambarName);
    $kategoriProduk->gambar = 'size/' . $validatedData['size'] . '/' . $gambarName;

    // simpan icon
    $icon = $request->file('icon');
    $iconName = time() . '-' . $icon->getClientOriginalName();
    $icon->move(public_path('assets/' . $validatedData['size']), $iconName);
    $kategoriProduk->icon = 'size/' . $validatedData['size'] . '/' . $iconName;

    $kategoriProduk->save();

    return redirect()->route('kategori-produk.index')->with('success', 'Kategori produk berhasil ditambahkan');
}

    

    public function show($slug)
    {
        $kategoriProduk = KategoriProduk::where('slug', $slug)->firstOrFail();
        return view('admin.kategori_produk.show', compact('kategoriProduk'));
    }

    public function edit($slug)
    {
        $kategoriProduk = KategoriProduk::where('slug', $slug)->firstOrFail();
        return view('admin.kategori_produk.edit', compact('kategoriProduk'));
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:kategori_produks,nama,'.$id,
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'required'
        ]);

        $kategoriProduks = KategoriProduk::find($id);
        $kategoriProduks->nama = $request->input('nama');
        $kategoriProduks->slug = Str::slug($request->input('nama'), '-');
        $kategoriProduks->size = $request->input('size');

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/size/', $filename);
            $kategoriProduks->gambar = $filename;
        }

        $kategoriProduks->save();

        return redirect()->route('kategori_produk.index')->with('success', 'Kategori produk berhasil diperbarui.');
    
    }



    public function destroy($slug)
    {
        $kategoriProduk = KategoriProduk::where('slug', $slug)->firstOrFail();
        $kategoriProduk->delete();
    
        return redirect()->route('kategori_produk.index')
            ->with('success', 'Kategori produk berhasil dihapus');
    }
}
