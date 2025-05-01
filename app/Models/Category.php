<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function stickers()
    {
        return $this->hasMany(Sticker::class, 'category_id');
    }
}
