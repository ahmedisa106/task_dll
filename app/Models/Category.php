<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_categories', 'admin_id', 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
