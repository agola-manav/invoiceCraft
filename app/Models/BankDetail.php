<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetail extends Model
{
    use SoftDeletes;

    public $table = 'bank_details';

    protected $fillable = [
        'company_id','bank_name','ac_no','isfc','upi_id','user_id'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
