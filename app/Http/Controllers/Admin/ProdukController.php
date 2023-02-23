<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JenisProduk;
use App\KategoriProduk;
use App\Product;
use Illuminate\Support\Str;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.product.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = KategoriProduk::all();

        $jenisproduk = JenisProduk::all();

        return view('admin.product.create',  [
  
            'kategori'         => $kategori,
  
            'jenisproduk'   => $jenisproduk
  
          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $products)

{
  $this->validate($request,[

    'nama'                => 'required',

    'kategori'            => 'required',

    'jenisproduk'         => 'required',

    'harga'               => 'required',

    'deskripsi'          => 'required',

    'bahan'              => 'required',

    'berat'              => 'required',

    'warna'              => 'required',

    'size'              => 'required',

    'stock'              => 'required',

    'gambar'             => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',

    'gambar2'             => 'image|mimes:jpg,png,jpeg,gif|max:2048',

    'gambar3'             => 'image|mimes:jpg,png,jpeg,gif|max:2048',

    'gambar4'             => 'image|mimes:jpg,png,jpeg,gif|max:2048',

    'gambar5'             => 'image|mimes:jpg,png,jpeg,gif|max:2048',

    'video'              => 'required',

    'meta_title'          => 'required',

    'meta_deskripsi'      => 'required',

    'meta_keyword'        => 'required',

  ]);

    $random = mt_rand(1000,9999);

    $kode_produk = "SKU".$random;

    $gambar = $request->gambar;
    

    if($gambar){

      $new_gambar = time().$gambar->getClientOriginalName();

      $gambar->move('assets/produk/', $new_gambar);

    }else{

      $new_gambar = "";

    }


    $gambar2 = $request->gambar2;

    if($gambar2){

      $new_gambar2 = time().$gambar2->getClientOriginalName();

      $gambar2->move('assets/produk/', $new_gambar2);

    }else{

      $new_gambar2 = "";

    }


    $gambar3 = $request->gambar3;

    if($gambar3){

      $new_gambar3 = time().$gambar3->getClientOriginalName();

      $gambar3->move('assets/produk/', $new_gambar3);

    }else{

      $new_gambar3 = "";

    }


    $gambar4 = $request->gambar4;

    if($gambar4){

      $new_gambar4 = time().$gambar4->getClientOriginalName();

      $gambar4->move('assets/produk/', $new_gambar4);

    }else{

      $new_gambar4 = "";

    }

    $gambar5 = $request->gambar5;
  if($gambar5){
    $new_gambar5 = time().$gambar5->getClientOriginalName();
  $gambar5->move('assets/produk/', $new_gambar5);
    }else{
  $new_gambar5 = "";
  }

  $video = $request->video;
  if($video){
    $new_video = time().$video->getClientOriginalName();
  $video->move('assets/produk/', $new_video);
    }else{
  $new_video = "";
  }

    $harga_discount = "";

    if($request->discount)
    {
      $currDis        = ($request->discount * $request->harga) / 100;
      $harga_discount  = $request->harga - $currDis; 
    }

    else
    {
      $harga_discount = "0";
    }

    $products = Product::create([

      'kode_produk'         => $kode_produk,

      'nama'                => $request->nama,

      'kategori'   => $request->kategori,

      'jenisproduk'         => $request->jenisproduk,

      'harga'               => $request->harga,

      'discount'            => $request->discount,

      'harga_discount'      => $harga_discount,

      'deskripsi'          => $request->deskripsi,

      'bahan'          => $request->bahan,

      'warna'          => $request->warna,

      'berat'          => $request->berat,

      'size'          => $request->size,

      'stock'          => $request->stock,

      'gambar'             => $new_gambar,

      'gambar2'             => $new_gambar2,

      'gambar3'             => $new_gambar3,

      'gambar4'             => $new_gambar4,

      'gambar5'             => $new_gambar5,
      
      'video'             => $new_video,

      'meta_title'          => $request->meta_title,

      'meta_deskripsi'      => $request->meta_deskripsi,

      'meta_keyword'        => $request->meta_keyword,

      'slug'                => Str::slug($request->nama)

    ]);


    $products->save();
        return redirect('/products')->with('success', 'Product has been added');
        session()->flash('message', 'Successfully added product!');

}

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('admin.product.show', compact('product'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $products = Product::all();
        $products = Product::whereSlug($slug)->first();
        return view('admin.product.edit', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $products = Product::where('slug', $slug)->first();
        $products->kode_produk = $request->input('kode_produk');
        $products->kategori = $request->input('kategori');
        $products->nama = $request->input('nama');
        $products->slug = Str::slug($request->nama, '-');
        $products->deskripsi = $request->input('deskripsi');
        $products->size = $request->input('size');
        $products->stock = $request->input('stock');
        $products->berat = $request->input('berat');
        $products->warna = $request->input('warna');
        $products->bahan = $request->input('bahan');
        $products->harga = $request->input('harga');
        $products->discount = $request->input('discount');
        
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/produk/', $filename);
            $products->gambar = $filename;
        }

        if($request->hasFile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/produk/', $filename);
            $products->video = $filename;
        }

        $products->update();
        return redirect()->route('products')->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
{
    $products = Product::where('slug', $slug)->firstOrFail();
    $products->delete();

    return redirect()->route('/products')->with('success', 'Product deleted successfully');
}

}
