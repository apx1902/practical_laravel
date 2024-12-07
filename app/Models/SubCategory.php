<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories'; 
    protected $fillable = [
        'sub_category_name',
        'category_id'
    ];

    //relation with category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
