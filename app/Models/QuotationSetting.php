<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationSetting extends Model
{
    public $table = 'quotation_settings';
    
    protected $fillable = [
        'company_id','quotation_terms','quotation_remarks',
        'quotation_prefix','quotation_counter','user_id'
    ];
}
