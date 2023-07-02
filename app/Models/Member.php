<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Member extends Model
{
    protected $fillable = [
        'title',
        'surname',
        'other_names',
        'email',
        'dob',
        'religion',
        'photo',
        'alt_contact',
        'marital_status',
        'phone_number',
        'postal_address',
        'landline',
        'gender',
        'district_id',
        'party_id',
        'constituency_id',
        'updated_by',
        'created_by'
    ];
    protected $table = 'member_info';


}
