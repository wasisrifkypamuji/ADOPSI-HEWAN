<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $primaryKey = 'id_laporan';

    protected $table = 'laporan';
    
    protected $fillable = [
        'user_id', 'id_adopsi', 'foto', 'video', 'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adopsi()
    {
        return $this->belongsTo(Adopsi::class, 'id_adopsi');
    }
}
