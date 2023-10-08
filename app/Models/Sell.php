<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $table = 'sells';

    protected $fillable = [
        'status_id',
        'admin_id',
        'customer_id',
        'units',
        'sub_total',
        'discount',
        'created_at',
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

    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }
}
