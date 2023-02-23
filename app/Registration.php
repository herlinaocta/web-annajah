<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    protected $table = 'users';

    protected $fillable = ['kode_member', 'name', 'email', 'telepon', 'alamat', 'password'];


}
