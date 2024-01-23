<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Verifikasi extends Model
{
    use HasFactory;
    protected $table = 'verifikasi';
    protected $fillable = [
        'user_id',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
