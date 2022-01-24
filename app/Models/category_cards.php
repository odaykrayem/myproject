<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_cards extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'card_id', 'price', 'status', 'message', 'created_at'];
}
