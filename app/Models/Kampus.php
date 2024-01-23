<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Kampus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kampus';
    protected $primaryKey = 'KampusID';
    public $timestamps = true;
    protected $fillable = [
        'KampusID',
        'NamaKampus',
        'Alamat',
        'Kontak',
        'Website',
        'Gambar'
    ];
}
