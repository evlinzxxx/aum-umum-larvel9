<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = "jurusans";

    protected $primaryKey = "jurusan";

    protected $keyType = 'string';

    protected $fillable = [
        'jurusan',
    ];

    public function siswa()
    {
        return $this->hasMany(Jurusan::class, 'jurusan', 'jurusan');
    }
}
