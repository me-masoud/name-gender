<?php

namespace App\Models;

use App\Models\Traits\NameRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use NameRelationsTrait;

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
