<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{   
    use SoftDeletes;

    public $table = 'companies';

    protected $fillable = [
        'name','phone_number','gst_number','email','website',
        'address','city','state','country','pincode',
        'image','sign','user_id'
    ];

    public function bankDetail() {
        return $this->hasOne(BankDetail::class);
    }

    public function invoiceSetting() {
        return $this->hasOne(InvoiceSetting::class);
    }

    public function quotationSetting() {
        return $this->hasOne(QuotationSetting::class);
    }
}
