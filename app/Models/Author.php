<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Author extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];
    
    public function products()
{
    return $this->belongsToMany(Product::class);
}

}



