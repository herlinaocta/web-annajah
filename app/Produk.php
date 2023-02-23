<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
      'kode_produk', 'nama', 'deskripsi', 'size', 'harga', 'discount', 'gambar', 'video'
  ];

    public function getImage()
  
    {
      if(!$this->gambar){
        return asset('assets/produk/default.png');
      }
      return asset('assets/produk/'.$this->gambar);
    }

    public function flashSales()
{
    return $this->hasMany(FlashSale::class);
}
}
