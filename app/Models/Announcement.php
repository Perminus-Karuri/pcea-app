<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Zone;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'user_id',
        'zone_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
}
