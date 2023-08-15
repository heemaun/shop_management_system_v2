<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $fillable = [
        'status_id',
        'admin_id',
        'units',
        'sub_total',
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

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
