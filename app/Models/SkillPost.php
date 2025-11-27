<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillPost extends Model
{
    protected $fillable = [
        'title',
        'type',
        'skills',
        'location',
        'time_commitment',
        'description',
    ];
}
