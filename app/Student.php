<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['id', 'fname', 'lname'];
    public $timestamps = false;
    protected $keyType = 'string';
}
