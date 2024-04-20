<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',

    ];

    public function project()
    {
        return $this->belongsTo(Campaign::class); // Replace Project with your actual project model name
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Replace User with your actual user model name
    }
}
