<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'price',
        'image',
        'category_id',
        'transparent_background',
        'youtube_url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
