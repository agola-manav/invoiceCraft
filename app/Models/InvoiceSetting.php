<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use SoftDeletes;

    public $table = 'invoice_settings';

    protected $fillable = [
        'company_id','invoice_terms','invoice_remarks',
        'invoice_prefix','invoice_counter','user_id'
    ];
}
