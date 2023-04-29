<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['product_code','name', 'active', 'price','cost','value','game_id'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
public function getActivitylogOptions(): LogOptions
{
    // TODO: Implement getActivitylogOptions() method.
    return LogOptions::defaults()
        ->logExcept(['product_code']);
}}
