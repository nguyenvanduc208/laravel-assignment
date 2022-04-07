<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; //trait

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'status', 
        'parent_id'
    ];
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parentCategory(){
        return $this->belongsTo(ParentCategory::class,'parent_id');
    }
}
