<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Beasiswa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'BeasiswaID';
    protected $table = 'beasiswa';

    protected $fillable = [
        'NamaBeasiswa',
        'CrawlingId',
        'Source',
        'Deskripsi',
        'Persyaratan',
        'TanggalPendaftaran',
        'TanggalPenutupan',
        'TahunMasuk',
        'Pembiayaan',
        'JumlahPenerima',
        'Kontak',
        'TipeBeasiswa',
        'KampusID',
        'PerusahaanID',
        'Gambar',
    ];

    protected $dates = [
        'TanggalPendaftaran',
        'TanggalPenutupan',
    ];

    public function kampus()
    {
        return $this->belongsTo(Kampus::class, 'KampusID');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'PerusahaanID');
    }

    public function jenjang()
    {
        return $this->belongsToMany(Jenjang::class, 'beasiswa_jenjang', 'BeasiswaID', 'JenjangID');
    }

    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class, 'beasiswa_jurusan', 'BeasiswaID', 'JurusanID');
    }

}
