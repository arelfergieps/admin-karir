<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $table = "apply";

    // Sesuaikan fillable untuk menambahkan kolom baru
    protected $fillable = [
        'nama',
        'email',
        'no_tlp',
        'alamat',
        'CV',
        'portofolio',
        'linkdln',    // Menambahkan kolom linkdln
        'github',     // Menambahkan kolom github
        'status'      // Menambahkan kolom status
    ];
}
