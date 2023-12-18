<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionStorage extends Model
{
    use HasFactory;

    protected $table = 'session_storages';

    protected $fillable = ['id','data','page_route'];
}
