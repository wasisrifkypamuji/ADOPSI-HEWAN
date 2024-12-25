<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    
    protected $fillable = ['username', 'password'];

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_admin');
    }

    public function hewan()
    {
        return $this->hasMany(Hewan::class, 'id_admin');
    }

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class, 'id_admin');
    }
}
