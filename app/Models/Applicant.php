<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = ['person_data_id', 'application_status', 'form_progress', 'reviewer_comments'];

    public function personData()
    {
        return $this->belongsTo(PersonData::class);
    }
}
