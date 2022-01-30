<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsUrls extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'logo', 'name'];

}
