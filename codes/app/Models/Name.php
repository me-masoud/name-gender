<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $fillable = [
        'name' ,
        'persian_pronounce',
        'en_name' ,
        'en_pronounce' ,
        'gender',
        'nationality',
        'description',
        'abjad',
        'popularity',
        'confirm'
    ];
    protected $table = 'names';
}
