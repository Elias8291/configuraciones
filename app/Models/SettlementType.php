<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    protected $table = 'settlement_types';

    protected $fillable = [
        'name',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}