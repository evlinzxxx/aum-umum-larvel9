<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelases";

    protected $primaryKey = "kelas";

    protected $keyType = 'string';

    protected $fillable = [
        'kelas',
    ];

    public function siswa()
    {
        return $this->hasMany(Kelas::class, 'kelas', 'kelas');
    }
}
