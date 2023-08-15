<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
        'status_id',
        'admin_id',
        'customer_id',
        'name',
        'balance',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    
    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
