<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $table = 'neighborhoods';

    protected $fillable = [
        'zip_code',
        'city_id',
        'name',
        'settlement_type_id',
        'municipality_id',
        'status',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function settlementType()
    {
        return $this->belongsTo(SettlementType::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}