<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'description',
        'place',
        'link',
        'picture',
        'date',
    ];
    public $timestamps = false;
}
