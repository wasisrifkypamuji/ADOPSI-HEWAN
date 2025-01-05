<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KirimHewan extends Model
{
    protected $table = 'kirim_hewans';
    protected $primaryKey = 'id_kirim';
    public $timestamps = true;
    
    protected $fillable = [
        'id_admin', 
        'user_id', 
        'id_kategori', 
        'nama_kategori',
        'nama_lengkap', 
        'nama_hewan', 
        'deskripsi', 
        'usia',
        'gender', 
        'foto', 
        'video', 
        'surat_perjanjian',
        'surat_keterangan_sehat', 
        'status',
        'bukti_terima',
        'alasan_penolakan'
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
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function getStatusLabelAttribute()
    {
        return [
            'proses' => 'Sedang Diproses',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak'
        ][$this->status] ?? $this->status;
    }
}