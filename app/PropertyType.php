<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    public $fillable = ['name'];

    public static $types = ['Condo', 'House', 'Land'];
}
