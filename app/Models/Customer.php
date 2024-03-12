<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Avatar;
use App\Models\Spouse;
use App\Models\Priority;
use App\Models\Dependent;
use App\Models\Transaction;
use App\Models\CustomerNeed;
use App\Models\FinancialStatement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }

    public function asset(): HasOne
    {
        return $this->hasOne(Asset::class);
    }

    public function spouse(): HasOne
    {
        return $this->hasOne(Spouse::class);
    }

    public function dependents(): HasMany
    {
        return $this->hasMany(Dependent::class);
    }

    public function priorities(): HasMany
    {
        return $this->hasMany(Priority::class);
    }

    public function customerNeeds(): HasMany
    {
        return $this->hasMany(CustomerNeed::class);
    }

    public function financialStatement(): HasOne
    {
        return $this->hasOne(FinancialStatement::class);
    }

}
