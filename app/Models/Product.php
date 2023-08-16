<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'status_id',
        'admin_id',
        'category_id',
        'name',
        'units',
        'price',
        'details',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}