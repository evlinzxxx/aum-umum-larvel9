<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    protected $table = "siswas";

    protected $primaryKey = "nisn";

    protected $guard = "user";

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sekolah',
        'nisn',
        'nama',
        'tingkatan',
        'jurusan',
        'kelas',
        'gender',
        'email',
        'password',
        'url_photo',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah', 'sekolah');
    }
    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'tingkatan', 'tingkatan');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan', 'jurusan');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }
    public function jawaban()
    {
        return $this->hasMany(LembarJawaban::class, 'id_jawaban', 'id_jawaban');
    }
    public function hasilIndividu()
    {
        return $this->belongsTo(HasilIndividu::class)->withPivot(['jumlah_ya'])->withTimeStamps();
    }
}
