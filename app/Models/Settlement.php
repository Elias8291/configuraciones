<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = ['municipality_id', 'locality_id', 'postal_code_id', 'name', 'type'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class);
    }
}
