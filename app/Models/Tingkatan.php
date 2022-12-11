<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    use HasFactory;

    protected $table = "tingkatans";

    protected $primaryKey = "tingkatan";

    protected $keyType = 'string';

    protected $fillable = [
        'tingkatan',
    ];

    public function siswa()
    {
        return $this->hasMany(Tingkatan::class, 'tingkatan', 'tingkatan');
    }
}
