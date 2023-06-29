<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Qualification extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'award_type',
        'created_by',
        'updated_by'
    ];
    protected $table = 'qualifications';
}
