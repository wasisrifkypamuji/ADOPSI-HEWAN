<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['username', 'email', 'password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

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

    // Di Model Admin, tambahkan:
    public function kirimHewan()
    {
        return $this->hasMany(KirimHewan::class, 'id_admin');
    }
}