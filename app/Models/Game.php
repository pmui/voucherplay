<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Game extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['code','title','type', 'image_url','active','trending','validation_fields', 'description', 'info', 'tnc'];

    protected $hidden = ['created_at','updated_at'];

    public function scopeActive($q)
    {
        return $q->where('active',true);
    }
    public function scopeSearch($q, $keyword)
    {
        return $q->where('title','like',"%$keyword%")->orWhere('code','like',"%$keyword%");
    }


    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        // TODO: Implement getActivitylogOptions() method.
        return LogOptions::defaults()
            ->logOnly(['type','active','trending']);
    }
}
