<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    public $table = 'bank_details';

    protected $fillable = [
        'company_id','bank_name','ac_no','isfc','upi_id','user_id'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
