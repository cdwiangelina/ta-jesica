<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamusSlangword extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'kata_slang',
        'kata_benar',
    ];
}
