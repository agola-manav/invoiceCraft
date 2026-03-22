<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    public $table = 'payment_modes';

    protected $fillable = [
        'user_id','name','status'
    ];
}
