<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'street',
        'exterior_number',
        'interior_number',
        'zip_code',
        'neighborhood_id',
        'municipality_id',
        'country_id',
        'reference_street_1',
        'reference_street_2',
        'status',
    ];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function personData()
    {
        return $this->hasMany(PersonData::class);
    }
}