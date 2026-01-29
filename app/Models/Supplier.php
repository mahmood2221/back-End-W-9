<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
protected $fillable = ['name', 'email', 'phone', 'user_id'];
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['cost_price', 'lead_time_days'])
            ->withTimestamps();
            
    }
    // داخل كلاس Supplier
public function user()
{
    return $this->belongsTo(User::class);
}
}
