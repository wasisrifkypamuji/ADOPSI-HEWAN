<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = ['id_admin', 'nama_kategori'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function hewan()
    {
        return $this->hasMany(Hewan::class, 'id_kategori');
    }
}
