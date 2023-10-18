<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'admin_id',
        'key',
        'value',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function imageObjects()
    {
        return $this->hasMany(ImageObject::class);
    }
}
