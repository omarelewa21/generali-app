<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;

class Asset extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'customer_id','car','scooter','house','bungalow'
    ];

    protected $casts = ['car' => 'boolean', 'scooter' => 'boolean', 'house' => 'boolean','bungalow' => 'boolean'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
