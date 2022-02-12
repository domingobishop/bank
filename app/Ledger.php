<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_by',
        'type',
        'amount',
        'current_balance',
        'notes'
    ];
}
