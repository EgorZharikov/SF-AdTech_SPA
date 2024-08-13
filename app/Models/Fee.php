<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function users()
    {
        return $this->hasMany(User::class, 'fee_id', 'id');
    }

    public function redirects()
    {
        return $this->hasMany(Fee::class, 'fee_id', 'id');
    }
}