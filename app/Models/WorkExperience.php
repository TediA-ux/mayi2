<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class WorkExperience extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'member_id',
        'organization',
        'profession_id',
        'year_from',
        'year_to',
        'created_by',
        'updated_by'
    ];

    protected $table = 'mp_work_experience';
}
