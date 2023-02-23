<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Size extends Model
{
    protected $table = 'size';
    protected $fillable = [
        'kategori', 'slug', 'deskripsi', 'gambar',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImage()
  
    {
      if(!$this->gambar){
        return asset('assets/size/default.png');
      }
      return asset('assets/size/'.$this->gambar);
    }
}
