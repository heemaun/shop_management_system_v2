<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_id',
        'name',
        'username',
        'gender',
        'address',
        'dob',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    
    public function accounts()
    {
        return $this->hasMany(Account::class);
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
    
    public function adminSells()
    {
        return $this->hasMany(Sell::class,'admin_id');
    }

    public function customerSells()
    {
        return $this->hasMany(Sell::class,'customer_id');
    }  

    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function adminTransactions()
    {
        return $this->hasMany(Transaction::class,'admin_id');
    }
    public function customerTransactions()
    {
        return $this->hasMany(Transaction::class,'customer_id');
    }
}
