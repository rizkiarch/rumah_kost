<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function kost()
    {
        return $this->hasMany(Kost::class);
    }
}
