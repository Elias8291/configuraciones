<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $table = 'classifications';

    protected $fillable = [
        'description',
    ];

    public function personData()
    {
        return $this->hasMany(PersonData::class);
    }
}