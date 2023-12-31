<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    use HasFactory;

    protected $table = 'sell_orders';

    protected $fillable = [
        'status_id',
        'admin_id',
        'sell_id',
        'product_id',
        'units',
        'price',
        'discount',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
