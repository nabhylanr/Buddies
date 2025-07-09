<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recap extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'company_id',
        'nama_perusahaan',
        'cabang',
        'sales',
        'keterangan'
    ];

    // Relasi dengan Task (satu recap bisa punya banyak task)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Accessor untuk mendapatkan format nama perusahaan lengkap
    public function getFullCompanyNameAttribute()
    {
        return $this->nama_perusahaan . ' - ' . $this->cabang;
    }
}