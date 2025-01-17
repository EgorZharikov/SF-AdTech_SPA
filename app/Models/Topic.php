<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;
    public $timestamps = false;

    public function offers()
    {
        return $this->hasMany(Offer::class, 'topic_id', 'id');
    }
}