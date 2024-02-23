<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Priority extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['customer_id','priority','sequence'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
