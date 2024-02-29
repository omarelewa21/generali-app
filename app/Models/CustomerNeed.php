<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerNeed extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'customer_id','type','relationship','child_name','child_dob',
        'spouse_name', 'spouse_dob', 'covered_amount','supporting_year', 'total_needed',
        'existing_policy','existing_amount','insurance_amount','fund_percentage', 
        'ideal_retirement','retirement_age','remaining_year','other_source','goal',
        'annual_return','risk_profile','potential_return','selection','critical_illness_plan',
        'medical_care_plan','critical_illness','health_care','hospital','room'
    ];
}
