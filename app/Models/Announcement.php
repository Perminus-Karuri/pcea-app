<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Zone;
use App\Models\Groups;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'user_id',
        'zone_id',
        'group_id',
    ];

    // one-to-many relationship
    public function user() {
        return $this->belongsTo(User::class);
    }

    // one-to-many relationship - announcement belong to a specific zone
    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    // one-to-many relationship - announcement belongs to a specific group
    public function group() {
        return $this->belongsTo(Group::class);
    }
}
