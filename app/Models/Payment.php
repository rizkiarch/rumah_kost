<?php

namespace App\Models;

use App\Models\Kontak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function kontak()
    {
        return $this->belongsTo(Kontak::class);
    }
}
