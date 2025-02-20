<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $table = 'representatives';

    protected $fillable = [
        'name',
        'first_last_name',
        'second_last_name',
        'curp',
        'faculty_id',
        'identification_id',
        'identification_number',
        'expedition_date',
        'email',
        'phone',
    ];

    public function personData()
    {
        return $this->hasMany(PersonData::class);
    }
}