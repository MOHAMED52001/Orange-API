<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContract extends Model
{
    use HasFactory;

    protected $table = 'course_supplier_contract';
    protected $fillable = [
        'supplier_id', 'course_id', 'price', 'course_state', 'course_place', 'signed_at'
    ];

    public $timestamps = false;

    //////////////////////Relations//////////////////////

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'contract_id');
    }
}
