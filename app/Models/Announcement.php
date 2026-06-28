<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// import models
use App\Models\User;
use App\Models\Zone;
use App\Models\Group;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'user_id',
        'zone_id',
        'group_id',
    ];

    // Many-to-one relationship: this announcement belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Many-to-one relationship: this announcement belongs to a zone
    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    // Many-to-one relationship: this announcement belongs to a group
    public function group() {
        return $this->belongsTo(Group::class);
    }
}
