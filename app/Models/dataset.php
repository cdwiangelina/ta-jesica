<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataset extends Model
{

    protected $fillable = [
        'id',
        'username',
        'tweet',
        'label',
    ];

    public function dataSet(){ // relasi dengan table user
        return $this->hasMany(preprocesing::class, 'id', 'dataset_id');
    }
}
