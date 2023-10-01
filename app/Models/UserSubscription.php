<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'expired_at',
        'renewed_at',
        'user_id',
        'subscription_id',
    ];
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
