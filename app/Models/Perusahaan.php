<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Perusahaan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'perusahaan';
    protected $primaryKey = 'PerusahaanID';
    public $timestamps = true;
    protected $fillable = [
        'PerusahaanID',
        'NamaPerusahaan',
        'Alamat',
        'Kontak',
        'Website',
        'Gambar',
    ];
}
