<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'name',
    ];

    public function accounts()
    {
        return $this->hasMany(Status::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    
    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    
    public function sells()
    {
        return $this->hasMany(Sell::class);
    }
    
    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function imageObjects()
    {
        return $this->hasMany(ImageObject::class);
    }
}
