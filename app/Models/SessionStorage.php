<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SessionStorage extends Model
{
    use HasFactory;

    protected $table = 'session_storages';

    protected $fillable = ['id','transaction_id','data','customer_id','customer_name','agent_id','agent_name','session_id','page_route'];



    // Scopes
    public function scopeFindTransactionId($query, $transactionId)
    {
        return $query->where('transaction_id', $transactionId);
    }

    public function scopeFindSessionId($query, $sessionId)
    {
        return $query->where('session_id',$sessionId);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    }

    // public function getUpdatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->timezone('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    // }

    public function getCustomerNameAttribute($value)
    {
        return $value ?? '-';
    }

    public function getCustomerIdAttribute($value)
    {
        return $value ?? '-';
    }

}
