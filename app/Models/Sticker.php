<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $table = 'stickers';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
