<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMasalah extends Model
{
    use HasFactory;
    protected $table = "kategori_masalahs";

    protected $primaryKey = "kode_kategori";

    protected $keyType = 'string';

    protected $fillable = [
        'kode_kategori', 'nama_kategori'
    ];

    public function jawaban()
    {
        return $this->hasMany(KategoriMasalah::class, 'kode_kategori', 'kode_kategori');
    }
    
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'kode_kategori', 'kode_kategori');

    }
    
    public function hasilIndividu()
    {
        return $this->belongsTo(HasilIndividu::class, 'kode_kategori', 'kode_kategori');

    }
    
}