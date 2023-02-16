<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = "sekolahs";

    protected $primaryKey = "sekolah";

    protected $keyType = 'string';

    protected $fillable = [
        'sekolah',
    ];

    public function siswa()
    {
        return $this->hasMany(Sekolah::class, 'sekolah', 'sekolah');
    }
}
