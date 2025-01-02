<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table = 'hewan';
    protected $primaryKey = 'id_hewan';
    
    protected $fillable = [
        'id_admin', 'id_kategori', 'nama_kategori', 'nama_hewan',
        'umur', 'gender', 'ras', 'deskripsi', 'foto', 'status_adopsi'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class, 'id_hewan');
    }
}
