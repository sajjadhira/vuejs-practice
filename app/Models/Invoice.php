<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'due_date',
        'number',
        'reference',
        'subtotal',
        'discount',
        'total',
        'terms_and_conditions',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
