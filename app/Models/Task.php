<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'datetime',
        'place',
        'implementor'
    ];

    protected $casts = [
        'datetime' => 'datetime',
    ];

    // Accessor untuk mendapatkan date key format Y-m-d (tanpa konversi timezone)
    public function getDateKeyAttribute()
    {
        // Pastikan menggunakan timezone lokal untuk menghindari pergeseran tanggal
        return $this->datetime->setTimezone(config('app.timezone', 'Asia/Jakarta'))->format('Y-m-d');
    }

    // Accessor untuk mendapatkan time format g:i A (dalam timezone lokal)
    public function getTimeAttribute()
    {
        return $this->datetime->setTimezone(config('app.timezone', 'Asia/Jakarta'))->format('g:i A');
    }

    // Accessor untuk mendapatkan ISO datetime
    public function getIsoDatetimeAttribute()
    {
        return $this->datetime->toISOString();
    }

    // Accessor tambahan untuk mendapatkan format 24 jam (untuk frontend)
    public function getTime24Attribute()
    {
        return $this->datetime->setTimezone(config('app.timezone', 'Asia/Jakarta'))->format('H:i');
    }

    // Accessor untuk mendapatkan tanggal dalam format yang mudah dibaca
    public function getFormattedDateAttribute()
    {
        return $this->datetime->setTimezone(config('app.timezone', 'Asia/Jakarta'))->format('d M Y');
    }

    // Mutator untuk memastikan datetime disimpan dengan benar
    public function setDatetimeAttribute($value)
    {
        // Jika value adalah string dari datetime-local input
        if (is_string($value)) {
            // Parse sebagai waktu lokal (bukan UTC)
            $this->attributes['datetime'] = Carbon::createFromFormat('Y-m-d\TH:i', $value, config('app.timezone', 'Asia/Jakarta'))->utc();
        } else {
            $this->attributes['datetime'] = $value;
        }
    }
}