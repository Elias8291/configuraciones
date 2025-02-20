<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'applicants';

    protected $fillable = [
        'person_data_id',
        'application_status',
        'form_progress',
        'reviewer_comments',
    ];

    public function personData()
    {
        return $this->belongsTo(PersonData::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}