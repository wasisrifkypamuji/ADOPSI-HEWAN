<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    protected $table = 'komen';

    protected $primaryKey = 'id_komen';
    
    protected $fillable = [
        'user_id', 'id_admin', 'username', 'foto', 'video', 'komen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
