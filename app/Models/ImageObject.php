<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageObject extends Model
{
    use HasFactory;

    protected $table = 'image_objects';

    protected $fillable = [
        'status_id',
        'user_id',
        'product_id',
        'settings_id',
        'url',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function settings()
    {
        return $this->belongsTo(Setting::class);
    }
}
