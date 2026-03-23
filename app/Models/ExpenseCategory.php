<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use SoftDeletes;

    public $table = 'expense_categories';

    protected $fillable = [
        'user_id','name','status'
    ];
}
