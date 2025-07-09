<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'recap_id',
        'description',
        'datetime',
        'place',
        'implementor',
        'status',
        'completed_at'
    ];
    
    protected $casts = [
        'datetime' => 'datetime',
        'completed_at' => 'datetime'
    ];

    // Relasi dengan Recap
    public function recap()
    {
        return $this->belongsTo(Recap::class);
    }

    // Accessor untuk mendapatkan title dari nama perusahaan
    public function getTitleAttribute()
    {
        return $this->recap ? $this->recap->nama_perusahaan : 'Perusahaan tidak ditemukan';
    }

    // Accessor untuk mendapatkan full company name
    public function getFullCompanyNameAttribute()
    {
        return $this->recap ? $this->recap->full_company_name : 'Perusahaan tidak ditemukan';
    }

    // Scope untuk task yang pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope untuk task yang completed
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Accessor untuk mendapatkan date key format Y-m-d (tanpa konversi timezone)
    public function getDateKeyAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('Y-m-d');
    }

    // Accessor untuk mendapatkan time format g:i A (dalam timezone lokal)
    public function getTimeAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('g:i A');
    }

    // Accessor untuk mendapatkan ISO datetime
    public function getIsoDatetimeAttribute()
    {
        return $this->datetime->toISOString();
    }

    // Accessor tambahan untuk mendapatkan format 24 jam (untuk frontend)
    public function getTime24Attribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('H:i');
    }

    // Accessor untuk mendapatkan tanggal dalam format yang mudah dibaca
    public function getFormattedDateAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('d M Y');
    }

    // Accessor untuk format waktu (alias untuk getTime24Attribute untuk konsistensi)
    public function getFormattedTimeAttribute()
    {
        return $this->getTime24Attribute();
    }

    // Accessor untuk format completed_at - PERBAIKAN UTAMA
    public function getFormattedCompletedAtAttribute()
    {
        if (!$this->completed_at) {
            return '-';
        }
        
        // Pastikan completed_at ditampilkan dalam timezone Jakarta
        return $this->completed_at->setTimezone('Asia/Jakarta')->format('d M Y H:i');
    }

    // Mutator untuk memastikan datetime disimpan dengan benar
    public function setDatetimeAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Jakarta')->utc();
        } else {
            $this->attributes['datetime'] = $value;
        }
    }

    // Mutator untuk completed_at - PERBAIKAN UTAMA
    public function setCompletedAtAttribute($value)
    {
        if ($value) {
            // Jika value adalah Carbon instance, pastikan dalam timezone Jakarta
            if ($value instanceof Carbon) {
                $this->attributes['completed_at'] = $value->setTimezone('Asia/Jakarta')->utc();
            } else {
                // Jika string, parse dengan timezone Jakarta
                $this->attributes['completed_at'] = Carbon::parse($value, 'Asia/Jakarta')->utc();
            }
        } else {
            $this->attributes['completed_at'] = null;
        }
    }

    // Method untuk menandai task sebagai selesai
    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => Carbon::now('Asia/Jakarta') // Pastikan timezone Jakarta
        ]);
    }

    // Method untuk mengembalikan task ke pending
    public function markAsPending()
    {
        $this->update([
            'status' => 'pending',
            'completed_at' => null
        ]);
    }

    // Method untuk cek apakah task sudah selesai
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Method untuk cek apakah task masih pending
    public function isPending()
    {
        return $this->status === 'pending';
    }

    // Method untuk mendapatkan waktu relatif completed_at
    public function getCompletedAtRelativeAttribute()
    {
        if (!$this->completed_at) {
            return null;
        }
        
        return $this->completed_at->setTimezone('Asia/Jakarta')->diffForHumans();
    }
}