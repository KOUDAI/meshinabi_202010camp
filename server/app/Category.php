<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function restaurans()
    // カテゴりからみて､レストランは複数なので｡Sをつける
    {
        return $this->hasMany('App\Restaurant');
    }
}
