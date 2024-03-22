<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FinancialStatement extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['customer_id','transaction_id','amount_available','change_in_amount','increment_amount'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
