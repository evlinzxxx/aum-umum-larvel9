<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LembarJawaban extends Model
{
    use HasFactory;

    protected $table = "lembar_jawabans";

    protected $primaryKey = "id_jawaban";

    protected $fillable = [
        'sekolah',
        'nisn',
        'tingkatan',
        'jurusan',
        'kelas',
        'kode_kategori',
        'kode_pertanyaan',
        'jawaban',
    ];

    public function categories()
    {
        return $this->hasMany(KategoriMasalah::class, 'kode_kategori','kode_kategori');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'kode_pertanyaan', 'kode_pertanyaan');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah', 'sekolah');
    }

    public function tingkatan()
    {
        return $this->belongsTo(Tingkatam::class, 'tingkatan', 'tingkatan');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan', 'jurusan');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas', 'kelas');
    }

    // public function hasilIndividu()
    // {
    //     return $this->hasMany(LembarJawaban::class, 'id_jawaban', 'id_jawaban');
    // }
}
