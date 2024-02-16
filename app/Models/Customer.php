<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title','full_name', 'country_code', 'mobile_number','house_phone_number_country_code','house_phone_number',
        'email','country','id_type','id_number','passport_number','birth_certh','police_number','registration_number',
        'gender','dob','age','habit','education_level','occupation','marital_status','children','customer_choice'
    ];

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

}
