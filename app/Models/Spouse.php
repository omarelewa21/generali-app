<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spouse extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'customer_id','relation','title','full_name','country','id_type','id_number','passport_number',
        'birth_cert','police_number','registration_number','dob','age','gender','habit','occupation','marital_status',
        'children'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
