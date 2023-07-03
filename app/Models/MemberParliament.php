<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class MemberParliament extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'member_id',
        'parliament_id',
        'responsibility',
        'created_by',
        'updated_by'
    ];

    protected $table = 'member_parliaments';
}
