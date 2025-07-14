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
        'keterangan',
        'status' // Tambahkan status ke fillable
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

    // Scope untuk filter berdasarkan status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Method untuk mengupdate status
    public function markAsCompleted()
    {
        $this->update(['status' => 'completed']);
    }

    public function markAsScheduled()
    {
        $this->update(['status' => 'scheduled']);
    }

    public function markAsPending()
    {
        $this->update(['status' => 'pending']);
    }

    // Status checkers
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isScheduled()
    {
        return $this->status === 'scheduled';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}