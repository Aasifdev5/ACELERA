<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['name','payer_email','user_id','campaign_id','amount','accepted'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function scopeSuccess($query)
    {
        return $query->whereStatus('success');
    }

    public function scopePending($query)
    {
        return $query->whereStatus('pending');
    }
}
