<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // Mendefinisikan event saat pembuatan jadwal baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jadwal) {
            $jadwal->status = 0; // Atur nilai status ke 0 saat pembuatan jadwal baru
        });
    }

    public function kontak()
    {
        return $this->belongsTo(Kontak::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
