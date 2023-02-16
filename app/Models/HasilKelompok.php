<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKelompok extends Model
{
    use HasFactory;

    protected $table = "hasil_kelompoks";

    protected $primaryKey = "id_ak";

    protected $fillable = [
        'kode_kategori','sekolah','tingkatan', 'jurusan', 'kelas','jumlah_tertinggi','jumlah_terendah', 'jumlah_masalah','rata_jumlah'
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'kode_pertanyaan','kode_pertanyaan');
    }
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'nisn','nisn');
    }

    public function categories()
    {
        return $this->hasMany(KategoriMasalah::class, 'kode_kategori','kode_kategori');
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

    public function HasilIndividu()
    {
        return $this->belongsTo(HasilIndividu::class, 'id_ai', 'id_ai');
    }

}
