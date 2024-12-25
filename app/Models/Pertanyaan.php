<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $primaryKey = 'id_pertanyaan';
    
    protected $fillable = [
        'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'surat_perjanjian'
    ];

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class, 'id_pertanyaan');
    }
}
