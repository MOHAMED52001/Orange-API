<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at'];


    ///////////////////////////Relations/////////////////////////////

    //Get The Supplier Courses 
    public function contracts()
    {
        return $this->hasMany(SupplierContract::class);
    }

    //Get The Supplier Money Data
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, SupplierContract::class, 'supplier_id', 'contract_id');
    }
}
