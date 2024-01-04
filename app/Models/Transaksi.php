<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode',
        'keterangan',
        'jenis',
        'detail',
        'nominal',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
