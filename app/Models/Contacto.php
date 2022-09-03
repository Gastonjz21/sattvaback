<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'subject',
        'cmessage'
    ];
}
