<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table = 'jenjang';

    protected $primaryKey = 'JenjangID';

    protected $fillable = [
        'NamaJenjang',
        'Deskripsi',
    ];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'JenjangID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'JenjangID');
    }
}
