<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karir extends Model
{
    use HasFactory;

    protected $table ="karir";
    protected $fillable = ['job_title','description','location'];
}
