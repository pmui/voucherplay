<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','reference', 'status', 'payment_method_id','subtotal', 'discount','admin_fee','total'];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
