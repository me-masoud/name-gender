<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $fillable = ['firstChar' , 'name' ,'enName', 'sex' , 'baseCulture' , 'sameNames'];
    protected $table = 'names';
}
