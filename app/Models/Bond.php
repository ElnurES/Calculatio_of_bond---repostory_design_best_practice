<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bond extends Model
{
    use HasFactory, SoftDeletes;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'bond_id');
    }
}
