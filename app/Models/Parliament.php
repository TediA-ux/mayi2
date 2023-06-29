<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Parliament extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'created_by',
        'updated_by'
    ];
    protected $table = 'parliaments';
}
