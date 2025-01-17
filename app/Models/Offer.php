<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = false;

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'offer_id', 'id');
    }
    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->preview_image);
    }
}