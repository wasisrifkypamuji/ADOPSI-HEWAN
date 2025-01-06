<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, CanResetPassword;
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'username', 'email', 'nama_lengkap', 'no_telepon', 
        'alamat', 'media_sosial', 'usia', 'pekerjaan', 'password'
    ];

    public function adopsi()
    {
        return $this->hasMany(Adopsi::class, 'user_id');
    }

    public function komen()
    {
        return $this->hasMany(Komen::class, 'user_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }

    public function kirimHewan()
    {
        return $this->hasMany(KirimHewan::class, 'user_id');
    }
}
