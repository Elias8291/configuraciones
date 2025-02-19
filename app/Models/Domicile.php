<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicile extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'municipality_id', 'locality_id', 'settlement_id', 'street', 'exterior_number', 'interior_number', 'reference_street_1', 'reference_street_2'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function settlement()
    {
        return $this->belongsTo(Settlement::class);
    }
}
