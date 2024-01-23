<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPrestasi extends Model
{
    use HasFactory;
    protected $table = 'riwayat_prestasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'prestasi',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
