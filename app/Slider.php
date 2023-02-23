<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'title2',
        'slug',
        'gambar',
        'link'
    ];
}
