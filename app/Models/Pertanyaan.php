<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = "pertanyaans";

    protected $primaryKey = "kode_pertanyaan";

    protected $keyType = 'string';

    protected $fillable = [
        'kode_pertanyaan', 'kode_kategori', 'pertanyaan'
    ];

    public function categories()
    {
        return $this->hasMany(KategoriMasalah::class, 'kode_kategori', 'kode_kategori');
    }
    public function jawaban()
    {
        return $this->hasMany(HasilIndividu::class, 'kode_pertanyaan', 'kode_pertanyaan');
    }
}

