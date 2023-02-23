<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = ['judul', 'deskripsi','gambar', 'video'];
  
  
  
    public function getImage()
  
    {
      if(!$this->gambar){
        return asset('assets/about/default.png');
      }
      return asset('assets/about/'.$this->gambar);
    }
}


