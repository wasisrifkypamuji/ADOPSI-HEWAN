<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract; 
class User extends Model
{
    use HasFactory;

    protected $table = 'user';

    protected $fillable = [
        'email', 
        'nama_lengkap',
        'username', 
        'no_telpon', 
        'alamat', 
        'media_sosial', 
        'usia', 
        'pekerjaan', 
        'password',
    ];
    protected $hidden = ['password'];
}