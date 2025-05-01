<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StickerUser extends Model
{
    protected $table = 'user_stickers';

    protected $fillable = [
        'user_id',
        'sticker_id',
        'state_id',
        'created_at',
        'updated_at',
    ];

    public function sticker()
    {
        return $this->belongsTo(Sticker::class, 'sticker_id');
    }
    
    public function state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
