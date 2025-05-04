<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'name',
        'text',
        'publishdate',
        'category',
        'tag',
        'country',
        'author',
        'comments',
        'image'
    ];

    protected $casts = [
        'publishdate' => 'date'
    ];
}