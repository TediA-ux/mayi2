<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Committee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'committee_name',
        'committee_type',
        'created_by',
        'updated_by'
    ];
    protected $table = 'committees';
}
