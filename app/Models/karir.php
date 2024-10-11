<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    use HasFactory;

    protected $table = "karir";

    // Menambahkan kolom baru ke dalam $fillable
    protected $fillable = [
        'job_title',
        'description',
        'location',
        'kategori',       // Kolom kategori
        'kualifikasi',    // Kolom kualifikasi
        'divisi',         // Kolom divisi
        'gaji',           // Kolom gaji
        'status'          // Kolom status (1 = show, 2 = hide)
    ];
}
