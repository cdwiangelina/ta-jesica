<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preprocesing extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'dataset_id',
        'cleaning',
        'tokenizing',
        'slangword',
        'stopword',
        'steming',
        'label'
    ];

    public function preData(){ // relasi dengan table user
        return $this->belongsTo(dataset::class, 'dataset_id', 'id');
    }
}
