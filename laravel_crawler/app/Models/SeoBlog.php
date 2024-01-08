<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoBlog extends Model
{
    use HasFactory;

    protected $table = 'seos_blog';
    protected $guarded = [''];

    const TYPE_TAG = 1;
    const TYPE_MENU = 2;
    const TYPE_ARTICLE = 3;
}
