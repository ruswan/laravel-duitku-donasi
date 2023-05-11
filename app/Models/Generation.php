<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all of the donasis for the Generation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function donasis()
    {
        return $this->hasMany(Donasi::class);
    }
}
