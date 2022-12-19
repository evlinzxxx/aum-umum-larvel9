<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilIndividu extends Model
{
    use HasFactory;
    protected $table = "hasil_individus";

    protected $primaryKey = "id_ai";

    protected $fillable = [
        'sekolah', 'nisn', 'tingkatan', 'jurusan', 'kelas', 'kode_kategori','kode_pertanyaan', 'jumlah_ya', 'persentase_masalah'
    ];

    public function categories()
    {
        return $this->hasMany(KategoriMasalah::class, 'kode_kategori','kode_kategori');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class,  'nisn', 'nisn');
    }

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

}
