<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity, Notifiable;

    protected $fillable = ['email','phone','game_code','product_code','price','cost', 'voucher_code','reference',
        'validation_fields','response','status', 'user_id'];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_code','product_code');
    }

    public function game()
    {
        return $this->belongsTo(Game::class,'game_code','code');
    }


    public function getActivitylogOptions(): LogOptions
    {
        // TODO: Implement getActivitylogOptions() method.
        return LogOptions::defaults()
            ->logOnly([ 'voucher_code','reference', 'response','status']);
    }
}
