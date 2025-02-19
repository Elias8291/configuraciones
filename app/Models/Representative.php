<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'first_last_name', 'second_last_name', 'curp', 'faculty_id', 'identification_id', 'identification_number', 'expedition_date', 'email', 'phone', 'person_data_id'];

    public function personData()
    {
        return $this->belongsTo(PersonData::class);
    }
}