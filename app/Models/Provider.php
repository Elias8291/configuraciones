<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'person_data_id',
        'applicant_id',
        'pv',
        'procedure_type',
        'validity',
    ];

    public function personData()
    {
        return $this->belongsTo(PersonData::class);
    }

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}