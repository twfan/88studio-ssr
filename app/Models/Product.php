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
        'youtube_url',
        'id_product',
        'best_selling',
        'new_seller',
        'sold_out',
        'product_name',
        'downloadable_product',
        'user_id', //its for owner of vtuber
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }
}
