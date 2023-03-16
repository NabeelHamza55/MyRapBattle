<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'video',
        'thumbnail',
        'length',
        'release_date',
        'description',
        'tranding',
        'category_id',
    ];
    protected $hidden = [
        'updated_at',
        'category_id',
    ];
}
