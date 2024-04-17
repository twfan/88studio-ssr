<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'category_id',
        'catgory_collection_id'
    ];
}
