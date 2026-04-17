<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kamar extends Model
{
    //
    use SoftDeletes;

    protected $table = 'kamar';

    protected $fillable = [
        'id',
        'nomor',
        'jenis',
        'harga',
        'ukuran',
        'fasilitas',
        'is_available',
        'keterangan',
        'images',
        'tipe_penghuni',
        'kapasitas',
        'kos_id',
    ];

    protected $casts = [
        'fasilitas' => 'array',
        'harga' => 'integer',
        'is_available' => 'boolean',
        'images' => 'array',
        'kapasitas' => 'integer',
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
    public function pembayarans()
{
    return $this->hasMany(Pembayaran::class);
}
}
