<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['contract_id', 'paid_amount', 'amount_left', 'paid_at'];
    public $timestamps = false;
}
