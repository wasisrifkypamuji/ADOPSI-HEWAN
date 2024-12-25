<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KirimHewan extends Model
{
    protected $primaryKey = 'id_kirim';
    
    protected $fillable = [
        'id_admin', 'user_id', 'id_kategori', 'nama_kategori', 'nama_lengkap',
        'nama_hewan', 'deskripsi', 'usia', 'gender', 'foto', 'video',
        'surat_perjanjian', 'surat_keterangan_sehat'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
