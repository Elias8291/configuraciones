<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonData extends Model
{
    protected $table = 'person_data';

    protected $fillable = [
        'user_id',
        'legal_person',
        'rfc',
        'curp',
        'business_name',
        'tradename',
        'web_page',
        'status',
        'activities',
        'economic_sector',
        'classification_id',
        'address_id',
        'representative_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function representative()
    {
        return $this->belongsTo(Representative::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}