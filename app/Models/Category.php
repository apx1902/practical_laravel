<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];

    //relation with subcategory
    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }
}
