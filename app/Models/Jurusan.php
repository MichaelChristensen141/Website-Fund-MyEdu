<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    protected $primaryKey = 'JurusanID';

    protected $fillable = [
        'NamaJurusan',
        'Deskripsi',
    ];

    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'JenjangID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'JurusanID');
    }
}
