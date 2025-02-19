<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['state_id', 'cve_mun', 'name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function localities()
    {
        return $this->hasMany(Locality::class);
    }
}
