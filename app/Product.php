<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\Extension\Table\Table;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'kode_produk', 'kategori', 'jenisproduk', 'nama', 'slug', 'deskripsi', 'harga', 'berat', 'warna', 'bahan', 'size', 'stock', 'harga_discount', 'discount', 'gambar', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'video', 'meta_title', 'meta_deskripsi', 'meta_keyword'
    ];

    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class);
    }

    public function jenisProduk()
    {
        return $this->belongsTo(JenisProduk::class, 'jenis_id');
    }


    public function getImage()
  
    {
      if(!$this->gambar){
        return asset('assets/produk/default.png');
      }
      return asset('assets/produk/'.$this->gambar);
    }
    
    public function getVideo()
    {
        if(!$this->video){
          return asset('assets/produk/default.png');
        }
        return asset('assets/produk/'.$this->video);
      }

    public function getRouteKeyName()
    {
    return 'slug';
    }

    public function setSlugAttribute($value)
{
    $this->attributes['slug'] = Str::slug($this->nama, '-');
}


}
