<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Front extends Model
{
    public function kategoriproduk()
    {
      return $this->belongsTo('App\KategoriProduk');
    }
}
