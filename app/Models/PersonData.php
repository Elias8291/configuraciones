<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonData extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'legal_person', 'rfc', 'curp', 'business_name', 'tradename', 'web_page', 'status', 'activities', 'economic_sector', 'classification_id', 'domicile_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function domicile()
    {
        return $this->belongsTo(Domicile::class);
    }

    public function applicants()
    {
        return $this->hasOne(Applicant::class);
    }

    public function providers()
    {
        return $this->hasOne(Provider::class);
    }

    public function representatives()
    {
        return $this->hasMany(Representative::class);
    }
}
