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

    public function recap()
    {
        return $this->belongsTo(Recap::class);
    }

    public function getTitleAttribute()
    {
        return $this->recap ? $this->recap->nama_perusahaan : 'Perusahaan tidak ditemukan';
    }

    public function getFullCompanyNameAttribute()
    {
        return $this->recap ? $this->recap->full_company_name : 'Perusahaan tidak ditemukan';
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function getDateKeyAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('Y-m-d');
    }

    public function getTimeAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('g:i A');
    }

    public function getIsoDatetimeAttribute()
    {
        return $this->datetime->toISOString();
    }

    public function getTime24Attribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('H:i');
    }

    public function getFormattedDateAttribute()
    {
        return $this->datetime->setTimezone('Asia/Jakarta')->format('d M Y');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->getTime24Attribute();
    }

    public function getFormattedCompletedAtAttribute()
    {
        if (!$this->completed_at) {
            return '-';
        }
        
        return $this->completed_at->setTimezone('Asia/Jakarta')->format('d M Y H:i');
    }

    public function setDatetimeAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $value, 'Asia/Jakarta')->utc();
        } else {
            $this->attributes['datetime'] = $value;
        }
    }

    public function setCompletedAtAttribute($value)
    {
        if ($value) {
            if ($value instanceof Carbon) {
                $this->attributes['completed_at'] = $value->setTimezone('Asia/Jakarta')->utc();
            } else {
                $this->attributes['completed_at'] = Carbon::parse($value, 'Asia/Jakarta')->utc();
            }
        } else {
            $this->attributes['completed_at'] = null;
        }
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => Carbon::now('Asia/Jakarta') 
        ]);
    }

    public function markAsPending()
    {
        $this->update([
            'status' => 'pending',
            'completed_at' => null
        ]);
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function getCompletedAtRelativeAttribute()
    {
        if (!$this->completed_at) {
            return null;
        }
        
        return $this->completed_at->setTimezone('Asia/Jakarta')->diffForHumans();
    }
}