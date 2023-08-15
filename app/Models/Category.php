<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'status_id',
        'admin_id',
        'parent_category',
        'name',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function childrenCategory()
    {
        return $this->hasMany(Category::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
