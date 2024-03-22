<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExistingPolicy extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'customer_id','transaction_id','role','full_name','company','inception_year','plan_type',
        'maturity_year','premium_mode','premium_contribution','life_coverage_amount','critical_illness_amount',
        'additional_benefit'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
