<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMode extends Model
{
    use SoftDeletes;
    
    public $table = 'payment_modes';

    protected $fillable = [
        'user_id','name','status'
    ];
}
