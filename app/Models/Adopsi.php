<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    protected $primaryKey = 'id_adopsi';
    protected $table = 'adopsi';
    protected $fillable = [
        'id_admin', 'user_id', 'username', 'nama_lengkap', 'email',
        'no_telepon', 'alamat', 'pekerjaan', 'id_hewan', 'id_pertanyaan',
        'nama_hewan', 'status_adopsi'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'id_hewan');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_adopsi');
    }
}
