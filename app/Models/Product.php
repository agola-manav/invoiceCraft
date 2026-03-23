<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    protected $fillable = [
        'company_id','user_id','name','unit'
        'hsn_code','gst_percent','price','item_type'
    ];
}
