<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Authenticatable
{
    use HasFactory;

    protected $table = "gurus";

    protected $primaryKey = "nip";

    protected $guard = "guru";

    protected $fillable = [
        'sekolah', 'nip', 'nama', 'gender', 'email', 'password', 'url_photo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah', 'sekolah');
    }
}
