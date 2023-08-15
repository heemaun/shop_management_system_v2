<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'purchase-orders';

    protected $fillable = [
        'status_id',
        'admin_id',
        'purchase_id',
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
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
