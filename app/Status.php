<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public static $statuses = ['Active', 'Inactive', 'Draft'];

    public function nko() {

    }
}
