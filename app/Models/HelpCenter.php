<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use HasFactory;

    // Tambahkan ini jika Laravel mencari tabel 'help_centres' (ejaan Inggris) 
    // padahal di migration namanya 'help_centers'
    protected $table = 'help_centers';

    protected $fillable = ['pertanyaan', 'jawaban', 'kategori'];
}