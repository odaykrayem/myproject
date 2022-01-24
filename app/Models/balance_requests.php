<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_requests extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type','message', 'amount', 'status'];
    // to indcate what is the type value will be returned in json
    // protected $casts = ['type' => 'boolean'];

}
